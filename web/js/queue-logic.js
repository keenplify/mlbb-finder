const socket = io("http://localhost:8001");

const USER = JSON.parse(_USERJSON);
const TIMERELEMENT = document.querySelector("#timer");
const BUTTONELEMENT = document.querySelector("#start_btn");

let is_queued = false;

function toggle() {
  is_queued = !is_queued;

  if (is_queued) return startQueue(1);
  else stopQueue();
}

function startQueue(preferenceId) {
  const callback = () => {
    //Timer
    const start = new Date().getSeconds();
    const interval = setInterval(() => {
      if (!is_queued) {
        return clearInterval(interval);
      }
      var delta = new Date().getSeconds() - start;
      TIMERELEMENT.innerHTML = delta;
    }, 1000);

    // Update Button
    BUTTONELEMENT.textContent = "Dequeue";
  };
  socket.emit("enqueue", USER, preferenceId, callback);
}

function stopQueue() {
  socket.emit("dequeue");

  TIMERELEMENT.innerHTML = "0";
}

function listUserPreferences() {
  $.ajax({
    url: "http://localhost/server/api/preferences/getUserPreferences.php",
    data: {
      createdBy: USER.user_id,
    },
    success: (data) => {
      if (data === "null") return console.log("Invalid user!");
      console.log(data, USER.user_id);
      const preferences = JSON.parse(data);
      console.log(preferences);
    },
  });
}