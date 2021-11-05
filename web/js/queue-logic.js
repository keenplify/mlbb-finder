const socket = io("http://localhost:8001");

const USER = JSON.parse(_USERJSON);
const TIMERELEMENT = document.querySelector("#timer");
const BUTTONELEMENT = document.querySelector("#start_btn");
const ONLINECOUNTELEMENT = document.querySelector("#onlineCount");

let is_queued = false;

function toggle() {
  is_queued = !is_queued;

  if (is_queued) {
    if (selectedPreference == undefined) {
      alert("You have no preference selected!");
      return;
    }
    return startQueue(selectedPreference);
  } else stopQueue();
}

function startQueue(preferenceId) {
  const callback = () => {
    //Timer
    const start = new Date();
    const interval = setInterval(() => {
      if (!is_queued) {
        return clearInterval(interval);
      }
      var delta = new Date(new Date() - start);
      const mins = delta.getMinutes();
      const secs = delta.getSeconds();
      TIMERELEMENT.innerHTML = `${mins}:${secs}`;
    }, 1000);

    // Update Button
    BUTTONELEMENT.textContent = "Dequeue";
  };
  socket.emit("enqueue", USER, preferenceId, callback);
}

socket.on("online_count", (data) => {
  ONLINECOUNTELEMENT.innerHTML = data;
});

socket.on("lobby_created", (data) => {
  window.location.href = "/web/lobby.php?id=" + data;
});

function stopQueue() {
  socket.emit("dequeue");
  BUTTONELEMENT.textContent = "Enqueue";
  TIMERELEMENT.innerHTML = "0";
}
