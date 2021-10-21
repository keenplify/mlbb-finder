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
  preference: Preference;
  user: User;
  client: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>;
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
  createdAt: any;
  updatedAt: any;
}

export interface Preference {
  preference_id: number;
  region: string;
  primaryRole: string;
  secondaryRole: string;
  gameMode: GameModes;
  createdBy: number;
}

export interface Lobby {
  players: {
    [key in string]?: {
      queue: Queue;
      preference: Preference;
    }; //Queue number
  };
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
