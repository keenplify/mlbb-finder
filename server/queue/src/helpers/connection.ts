import { createConnection } from "mysql2";

const connection = createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "mlbb_finder",
});

export const useConnection = () => connection;
