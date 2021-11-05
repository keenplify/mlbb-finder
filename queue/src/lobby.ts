import { Server } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { usePromisifiedConnection } from "./helpers/connection";
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

  // Initial queries
  await connection.query(
    `INSERT INTO tbl_lobby (uuid) VALUES ("${lobby.id}");`
  );
  await connection.query(
    `UPDATE tbl_users SET currentLobbyUUID='${
      lobby.id
    }' WHERE user_id IN (${lobby.players
      .map((q) => q.clientData.user.user_id)
      .join(",")});`
  );
};
