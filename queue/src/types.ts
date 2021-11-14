import { Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";

export interface Init {
  method: "init";
  params: {
    userId: number;
    preferenceId: number;
  };
}

export type Data = Init;

export interface ClientData {
  preferenceId?: number;
  client: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>;
  user?: User;
}

export interface Queue {
  queue_id: number;
  createdBy: number;
  preferenceId: number;
}

export interface User {
  user_id: number;
  firstname: string;
  lastname: string;
  email: string;
  username: string;
  password: string;
  birthday: any;
  currentLobbyUUID: string;
  createdAt: any;
  updatedAt: any;
}

export interface Preference {
  preference_id: number;
  region: string;
  primaryRole: string;
  secondaryRole: string;
  gameMode: GameModes;
  mlbbdata_id: number;
  createdBy: number;
}

export type LobbyPlayers = {
  [key in string]?: {
    queue: Queue;
    preference: Preference;
    clientData?: ClientData;
  }; //Queue number
};

export interface Lobby {
  players: LobbyPlayers;
  id: string;
  gamemode: GameModes;
}

export type Roles =
  | "Tank"
  | "Fighter"
  | "Marksman"
  | "Mage"
  | "Assassin"
  | "Support";

export type GameModes = "Classic" | "Rank" | "Brawl";

export type Message = {
  message: string;
  createdAt: Date;
  user: User;
};
