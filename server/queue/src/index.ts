import { createServer } from "http";
import { Server } from "socket.io";
import { MatchmakingLoop } from "./matchmaking";
import { Listener } from "./socket";

const httpServer = createServer();
const io = new Server(httpServer);
const port = 8001;

io.on("connection", Listener);

httpServer.listen(port).on("connect", () => {
  console.log("Queue Websocket started at port " + port);
});

//Infinite Matchmaking Loop
function start() {
  setTimeout(function () {
    console.log("Matchmaking Loop started");
    MatchmakingLoop().then();
    // Again
    start();

    // Every 3 sec
  }, 3000);
}

// Begins
start();
