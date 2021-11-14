const socket = io("http://localhost:8001");
const MESSAGESCONTAINER = document.querySelector("#messages_container");
const MAINCONTAINER = $(".main");

let USER = JSON.parse(_USERJSON);
let LOBBYMESSAGES = [];
let LOBBYMESSAGEAUTHORS = [];
let LOBBY;

function setMessages(messages) {
  LOBBYMESSAGES = messages;
  renderMessages();
}

function addMessage(data) {
  LOBBYMESSAGES.push(data.newMessage);

  LOBBYMESSAGEAUTHORS = [...LOBBYMESSAGEAUTHORS, ...data.message_authors];
  renderMessages();
}

function renderMessages() {
  let innerHTML = "";
  LOBBYMESSAGES.map((e) => {
    const author = LOBBYMESSAGEAUTHORS.find((v) => v.user_id == e.createdBy);
    innerHTML += MessageCardFn(e, author);
  });

  MESSAGESCONTAINER.innerHTML = innerHTML;
  scrollSmoothToBottom(".main");
}

socket.emit("join_lobby", USER, (data) => {
  LOBBY = JSON.parse(data.lobby[0].json);
  LOBBYMESSAGEAUTHORS = [...LOBBYMESSAGEAUTHORS, ...data.message_authors];
  USER = data.__user;

  setMessages(data.messages);
  setLobbyData();
});

socket.on("new_message", (data) => {
  addMessage(data);
});

function scrollSmoothToBottom(id) {
  var div = document.querySelector(id);
  $(id).animate(
    {
      scrollTop: div.scrollHeight - div.clientHeight,
    },
    250
  );
}

async function setLobbyData() {
  const data = await Promise.all(
    Object.keys(LOBBY.players).map(async (playerRole) => {
      const player = LOBBY.players[playerRole];
      const mlbbdataJSON = await fetch(
        "http://localhost/server/api/mlbbdata/read.php?data_id=" +
          player.preference.mlbbdata_id
      );
      const userJSON = await fetch(
        "http://localhost/server/api/users/index.php?user_id=" +
          player.preference.createdBy
      );

      const user = JSON.parse(await userJSON.text());
      const mlbbdata = JSON.parse(await mlbbdataJSON.text());
      return `
          <div class="player-card">
            <h6>
              ${user.username}
              <span class="badge bg-primary">${playerRole}</span>
            </h6>
            <div>
              <span>IGN: <span class="badge bg-success">${mlbbdata.ign}</span></span>
              <span>MLID: <span class="badge bg-danger">${mlbbdata.mlid}</span></span>
            </div>
          </div>
        `;
    })
  );

  document.querySelector("#users-container").innerHTML = data.join("");
}
