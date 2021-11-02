import { createConnection } from "mysql2";
import { createConnection as createPromisifiedConnection } from "mysql2/promise";

const OPTIONS = {
  host: "localhost",
  user: "root",
  password: "",
  database: "mlbb_finder",
};

const connection = createConnection(OPTIONS);

const promisifiedConnection = createPromisifiedConnection(OPTIONS);

export const useConnection = () => connection;
export const usePromisifiedConnection = async () => await promisifiedConnection;
