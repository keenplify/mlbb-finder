import { Lobby, Preference, Queue } from "./types";
import { useConnection } from "./helpers/connection";
import dayjs from "dayjs";
import { mmRole } from "./matchmaking-logics/roles";
import { mmRegion } from "./matchmaking-logics/region";
import util from "util";
import { filter } from "./helpers/filter";

const connection = useConnection();

export const MatchmakingLoop = async () => {
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

            mmRegion(potentialLobbies, preference, q);
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

  // AFTER THE LOOP
  setTimeout(() => {
    const lobbiesFormed = potentialLobbies
      .map((lobby) => {
        const keys = Object.keys(lobby.players);
        if (keys.length >= 5) {
          const validPlayers = keys
            .map((key, i) => {
              if (i <= 4) return lobby.players[key];
            })
            .filter(filter);

          return {
            ...lobby,
            players: validPlayers,
          };
        }
      })
      .filter(filter);

    console.log("Valid Lobbies: ", lobbiesFormed);
  }, 1000);
};
