import { Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { ClientData, Preference, User } from "./types";
import { usePromisifiedConnection } from "./helpers/connection";

export const Listener = async (
  client: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  clientDataArray: ClientData[]
) => {
  const connection = await usePromisifiedConnection();
  let _user: User;
  let _preferenceId: number;

  client.on(
    "enqueue",
    async (user: User, preferenceId: number, cb: () => any) => {
      clientDataArray[user.user_id] = {
        client,
        preferenceId,
        user,
      };
      _user = user;
      _preferenceId = preferenceId;

      await connection.query(
        `INSERT INTO tbl_queue (createdBy, preferenceId) VALUES (${user.user_id},${preferenceId})`
      );

      cb();
    }
  );

  const dequeue = async () => {
    if (_user)
      await connection.query(
        `DELETE FROM tbl_queue WHERE createdBy=${_user.user_id}`
      );
  };

  client.on("dequeue", dequeue);

  client.on("disconnect", () => {
    _user && console.log("User " + _user.user_id + " has disconnected.");
    dequeue();
  });
};
