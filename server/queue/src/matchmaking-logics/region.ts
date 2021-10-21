import { filter } from "../helpers/filter";
import { Lobby, Preference, Queue } from "../types";
import { mmRole } from "./roles";

export function mmRegion(
  potentialLobbies: Lobby[],
  preference: Preference,
  q: Queue
) {
  //IF LOBBY FOUND THAT A PLAYER IS IN PLAYER REGION
  const optimalSameRegionLobbiesIndex = potentialLobbies
    .map(
      (lobby, key) =>
        lobby.players &&
        Object.values(lobby.players).find(
          (val) => val.preference.region == preference.region
        ) &&
        key
    )
    .filter(filter);

  if (optimalSameRegionLobbiesIndex.length > 0) {
    mmRole(
      potentialLobbies,
      preference,
      q,
      true,
      optimalSameRegionLobbiesIndex
    );
  } else {
    const newRoom: Lobby = { players: {}, gamemode: preference.gameMode };
    newRoom.players[preference.primaryRole] = { queue: q, preference };

    potentialLobbies.push(newRoom);
    return true;
  }
}
