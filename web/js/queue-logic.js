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

function Alert_CheckMLBBData() {
  $.ajax({
    type: "GET",
    url: `http://localhost/server/api/mlbbdata/getUserMLBBData.php?createdBy=${USER.user_id}`,
  }).done((json) => {
    const data = JSON.parse(json);
    if (data?.length === 0) {
      $("#alerts").append(`
        <div class="alert alert-danger" role="alert" id="alert-nomlbbdata">
          You are unable to queue because you currently don't have a linked Mobile Legends Account. <a href="http://localhost/web/mlbbdata.php">Click here to link an account.</a>
        </div>
      `);
      $("#start_btn").attr("disabled", true);
    } else {
      const alert = $("#alert-nomlbbdata");
      if (alert.length) alert.remove();
      $("#start_btn").attr("disabled", false);
    }
  });
}

function Alert_CheckLobby() {
  if (USER.currentLobbyUUID) {
    $("#alerts").append(`
      <div class="alert alert-primary align-items-end" role="alert" id="alert-haslobby">
        You are currently in a lobby.
        <hr>
        <a class="btn btn-primary" href="http://localhost/web/lobby.php?id=${USER.currentLobbyUUID}">Join Lobby</a>
        <a class="btn btn-danger" href="http://localhost/server/api/lobby/leave.php">Leave Lobby</a>
      </div>
    `);
  }
}

Alert_CheckMLBBData();
Alert_CheckLobby();
