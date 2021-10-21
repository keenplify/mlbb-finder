import { Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { ClientData, Data } from "./types";
import { useConnection } from "./helpers/connection";

const connection = useConnection();

export const Listener = (
  client: Socket<DefaultEventsMap, DefaultEventsMap, DefaultEventsMap>
) => {
  let clientData: ClientData;

  client.on("event", (data: Data) => {
    if (data.method === "init") {
      connection.query(
        `
        INSERT INTO 'tbl_queue' (createdBy, preferenceId)
        VALUES ('${data.params.userId}', '${data.params.preferenceId}');
      `
      );
      connection.query(
        `
        SELECT * FROM 'tbl_preference' WHERE preference_id=${data.params.preferenceId};
        `,
        (err, result, fields) => {
          console.log({ err, result, fields });
        }
      );
    }
  });

  client.on("disconnect", () => {
    connection.query(
      `DELETE FROM 'tbl_queue' WHERE createdBy=${clientData.user.user_id}`
    );
  });
};
