import { createServer } from "http";
import { Server, Socket } from "socket.io";
import { DefaultEventsMap } from "socket.io/dist/typed-events";
import { v4 } from "uuid";
import { MatchmakingLoop } from "./matchmaking";
import { Listener } from "./socket";
import { ClientData, Lobby } from "./types";

const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "http://localhost",
    methods: ["GET", "POST"],
  },
});
const port = 8001;

let clientDataArray: ClientData[] = [];
let lobbies: Lobby[] = [];

io.on("connection", (socket) => Listener(socket, clientDataArray));

httpServer.listen(port, () => {
  console.log("Queue Websocket started at port " + port);
});

//Infinite Matchmaking Loop
function start() {
  setTimeout(function () {
    // console.log("Matchmaking Loop started " + v4());
    MatchmakingLoop(io, clientDataArray).then();
    // Again
    start();

    // Every 3 sec
  }, 3000);
}

// Begins
start();
