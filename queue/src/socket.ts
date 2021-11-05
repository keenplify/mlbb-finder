import { Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { ClientData, Preference, User } from "./types";
import { usePromisifiedConnection } from "./helpers/connection";

export const Listener = async (
  client: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>,
  clientDataArray: ClientData[],
  clients: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>[]
) => {
  clients.push(client);
  const connection = await usePromisifiedConnection();
  let _user: User;
  let _preferenceId: number;

  function updateQueueCount() {
    const filtered = clientDataArray.filter((d) => d != undefined);

    filtered.forEach((d) => d.client.emit("online_count", filtered.length));
  }

  client.on("join_lobby", async (user: User, cb?: (data: any) => {}) => {
    const _user = await connection.query(
      `SELECT * from tbl_users WHERE user_id=${user.user_id}`
    );
    const __user = _user[0][0];

    const messages = await connection.query(
      `SELECT * FROM tbl_message WHERE lobbyUUID='${__user.currentLobbyUUID}'`
    );

    const __authors =
      Array.isArray(messages[0]) && messages[0].map((e) => e.createdBy);

    const filtered = __authors.filter(function (item, pos) {
      return __authors.indexOf(item) == pos;
    });

    const message_authors = await connection.query(
      `SELECT * FROM tbl_users WHERE user_id IN (${filtered.join(",")})`
    );

    client.join(__user.currentLobbyUUID);
    if (cb)
      cb({
        messages: messages[0],
        __user,
        message_authors: message_authors[0],
      });
  });

  client.on(
    "add_message",
    async (message: string, user: User, cb?: (data: any) => {}) => {
      await connection.query(
        `INSERT INTO tbl_message (message, lobbyUUID, createdBy) VALUES ("${message}", "${user.currentLobbyUUID}", ${user.user_id});`
      );

      const newMessage = await connection.query(
        `SELECT * FROM tbl_message WHERE message="${message}" AND lobbyUUID="${user.currentLobbyUUID}";`
      );

      const __authors =
        Array.isArray(newMessage[0]) && newMessage[0].map((e) => e.createdBy);

      const filtered = __authors.filter(function (item, pos) {
        return __authors.indexOf(item) == pos;
      });

      const message_authors = await connection.query(
        `SELECT * FROM tbl_users WHERE user_id IN (${filtered.join(",")})`
      );

      client.to(user.currentLobbyUUID).emit("new_message", {
        newMessage: newMessage[0][0],
        message_authors: message_authors[0],
      });
      cb({ newMessage: newMessage[0][0], message_authors: message_authors[0] });
    }
  );

  client.emit(
    "online_count",
    clientDataArray.filter((d) => d != undefined).length
  );

  client.on(
    "enqueue",
    async (user: User, preferenceId: number, cb: () => any) => {
      if (preferenceId == undefined) return;

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

      updateQueueCount();
      cb();
    }
  );

  const dequeue = async () => {
    if (_user)
      await connection.query(
        `DELETE FROM tbl_queue WHERE createdBy=${_user.user_id}`
      );

    if (_user) clientDataArray[_user?.user_id] = undefined;
    updateQueueCount();
  };

  client.on("dequeue", dequeue);

  client.on("disconnect", () => {
    clients.splice(clients.indexOf(client), 1);
    _user && console.log("User " + _user.user_id + " has disconnected.");
    dequeue();
  });
};
