import { ClientData, Lobby, LobbyPlayers, Preference, Queue } from "./types";
import { useConnection } from "./helpers/connection";
import dayjs from "dayjs";
import { mmRole } from "./matchmaking-logics/roles";
import { mmRegion } from "./matchmaking-logics/region";
import util from "util";
import { filter } from "./helpers/filter";
import { Server, Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { v4 } from "uuid";
import { CreateLobby } from "./lobby";

const connection = useConnection();

export const MatchmakingLoop = async (
  io: Server<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  clientDataArray: ClientData[]
) => {
  let potentialLobbies: Lobby[] = [];
  //Get all active matchmaking users
  let isoDate = dayjs().subtract(120, "minutes").toDate().toISOString();
  //GET PLAYERS QUEUEING BEFORE ISODATE
  connection.query(
    `SELECT * FROM tbl_queue WHERE createdAt > '${isoDate}'`,
    function (err, queue: Queue[]) {
      if (err) return console.log(err);
      const preferenceIdsArray = queue.map((q) => q.preferenceId);
      connection.query(
        `SELECT * FROM tbl_preference WHERE preference_id IN (${preferenceIdsArray.join(
          ","
        )})`,
        (err, preferences: Preference[]) => {
          queue.forEach((q) => {
            const preference = preferences.find(
              (p) => p.preference_id === q.preferenceId
            );

            mmRole(potentialLobbies, preference, q, true);
          });
        }
      );
    }
  );

  //After the isoDate minute (High priority queue)
  connection.query(
    `SELECT * FROM tbl_queue WHERE createdAt < '${isoDate}'`,
    function (err, queue: Queue[]) {
      if (err) return console.log(err);

      const preferenceIdsArray = queue.map((q) => q.preferenceId);
      connection.query(
        `SELECT * FROM tbl_preference WHERE preference_id IN (${preferenceIdsArray.join(
          ","
        )})`,
        (err, preferences: Preference[]) => {
          queue.forEach((q) => {
            const preference = preferences.find(
              (p) => p.preference_id === q.preferenceId
            );

            mmRole(potentialLobbies, preference, q, true);
          });
        }
      );
    }
  );

  // AFTER THE LOOP, TRIM ROOMS TO ONLY HAVE 5 PLAYERS OF ANY ROLES
  setTimeout(async () => {
    const lobbiesFormed: Lobby[] = potentialLobbies
      .map((lobby) => {
        const keys = Object.keys(lobby.players);
        if (keys.length >= 5) {
          let players: LobbyPlayers = {};

          const validPlayers = keys
            .map((key, i) => {
              if (i <= 4) return lobby.players[key];
            })
            .filter(filter)
            .map((player) => {
              return {
                clientData: clientDataArray[player.queue.createdBy],
                ...player,
              };
            });

          validPlayers.forEach((validPlayer) => {
            if (
              !Object.keys(players).includes(validPlayer.preference.primaryRole)
            ) {
              players[validPlayer.preference.primaryRole] = validPlayer;
            }
          });

          return {
            ...lobby,
            players,
            id: v4(),
          };
        }
      })
      .filter(filter);

    let queues: Queue[] = [];

    lobbiesFormed.map((lobby) => {
      Object.values(lobby.players).forEach((player) => {
        player.clientData.client.emit("lobby_created", lobby.id);
        queues.push(player.queue);
      });

      CreateLobby(io, lobby);
    });

    if (queues.length > 0) {
      const query = `DELETE FROM tbl_queue WHERE queue_id IN (${queues
        .map((q) => q.queue_id)
        .join(",")})`;
      connection.query(query);
    }
  }, 1000);
};
