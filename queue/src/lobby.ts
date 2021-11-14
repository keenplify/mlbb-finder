import { Server } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { usePromisifiedConnection } from "./helpers/connection";
import { Lobby, LobbyPlayers } from "./types";

export const CreateLobby = async (
  io: Server<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  lobby: Lobby
) => {
  const connection = await usePromisifiedConnection();
  let players: LobbyPlayers = {};
  Object.keys(lobby.players).forEach((key) => {
    const player = lobby.players[key];
    players[key] = {
      preference: player.preference,
      queue: player.queue,
    };
  });
  const lobbyJSON = JSON.stringify({
    id: lobby.id,
    gamemode: lobby.gamemode,
    players,
  });
  console.log(lobbyJSON);
  // Initial queries
  await connection.query(
    `INSERT INTO tbl_lobby (uuid, json) VALUES ('${lobby.id}', '${lobbyJSON}');`
  );
  await connection.query(
    `UPDATE tbl_users SET currentLobbyUUID='${
      lobby.id
    }' WHERE user_id IN (${Object.values(lobby.players)
      .map((q) => q.clientData.user.user_id)
      .join(",")});`
  );
};
