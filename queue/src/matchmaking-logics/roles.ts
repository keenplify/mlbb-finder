import { v4 } from "uuid";
import { uuid } from "uuidv4";
import { filter } from "../helpers/filter";
import { Lobby, Preference, Queue } from "../types";

const checkPriority = (
  lobby: Lobby,
  key: number,
  priorityIndexes: number[]
) => {
  if (priorityIndexes?.length > 0) {
    if (priorityIndexes.findIndex((num) => num == key)) return lobby;
    return;
  }
  return lobby;
};

/** Matchmaking based on role
 * @return boolean
 */
export const mmRole = (
  potentialLobbies: Lobby[],
  preference: Preference,
  q: Queue,
  createRoomAtFail: boolean = false,
  priorityLobbiesIndexes?: number[]
) => {
  // PRIMARY PREFERENCES: PRIMARYROLE/SECONDARYROLE
  const optimalPrimaryRoleLobbyIndex = potentialLobbies
    .filter((lobby) => lobby.gamemode == preference.gameMode)
    .map((lobby, key) => checkPriority(lobby, key, priorityLobbiesIndexes))
    .filter(filter)
    .findIndex((lobby) => {
      return !lobby.players[preference.primaryRole];
    });

  if (optimalPrimaryRoleLobbyIndex >= 0) {
    potentialLobbies[optimalPrimaryRoleLobbyIndex].players[
      preference.primaryRole
    ] = { queue: q, preference };
    return true;
  } else {
    // IF LOBBY WITH PRIMARY ROLE NOT FOUND, TRY SECONDARY ROLE
    const optimalSecondaryRoleLobbyIndex = potentialLobbies
      .filter((lobby) => lobby.gamemode == preference.gameMode)
      .map((lobby, key) => checkPriority(lobby, key, priorityLobbiesIndexes))
      .filter(filter)
      .findIndex((lobby) => !lobby.players[preference.secondaryRole]);
    if (optimalSecondaryRoleLobbyIndex >= 0) {
      potentialLobbies[optimalSecondaryRoleLobbyIndex].players[
        preference.secondaryRole
      ] = { queue: q, preference };
      return true;
    } else if (createRoomAtFail) {
      //IF WALA NA TALAGA, GAWA KA NALANG SARILI MONG ROOM LONER
      const newRoom: Lobby = {
        players: {},
        gamemode: preference.gameMode,
        id: v4(),
      };
      newRoom.players[preference.primaryRole] = { queue: q, preference };

      potentialLobbies.push(newRoom);
      return true;
    }
  }
  return false;
};
