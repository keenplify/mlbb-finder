import { Server } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { usePromisifiedConnection } from "./helpers/connection";
import { simpleStringify } from "./helpers/stringify";
import { ClientData, GameModes, Message, Preference, Queue } from "./types";

type Lobby = {
  players: {
    queue: Queue;
    preference: Preference;
    clientData: ClientData;
  }[];
  id: string;
  gamemode: GameModes;
};

export const CreateLobby = async (
  io: Server<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  lobby: Lobby
) => {
  const connection = await usePromisifiedConnection();
  const lobbyJSON = JSON.stringify({
    id: lobby.id,
    gamemode: lobby.gamemode,
    players: lobby.players.map((e) => {
      return {
        preference: e.preference,
        user: e.clientData.user,
      };
    }),
  });
  console.log(lobbyJSON);
  // Initial queries
  await connection.query(
    `INSERT INTO tbl_lobby (uuid, json) VALUES ('${lobby.id}', '${lobbyJSON}');`
  );
  await connection.query(
    `UPDATE tbl_users SET currentLobbyUUID='${
      lobby.id
    }' WHERE user_id IN (${lobby.players
      .map((q) => q.clientData.user.user_id)
      .join(",")});`
  );
};
