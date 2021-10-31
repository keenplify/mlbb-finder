import { Server } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
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

export const CreateLobby = (
  io: Server<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  lobby: Lobby
) => {
  let messages: Message[] = [];

  //Subscribes the client to lobby Id
  lobby.players.forEach((player) => {
    const client = player.clientData.client;

    client.join(lobby.id);

    client.on("create_message", async (message: string) => {
      const _message: Message = {
        message,
        createdAt: new Date(),
        user: player.clientData.user,
      };

      messages.push(_message);

      io.to(lobby.id).emit("new_message", _message);
    });
  });
};
