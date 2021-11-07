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
  console.log(LOBBY);
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
    LOBBY.players.map(async (player) => {
      const mlbbdataJSON = await fetch(
        "http://localhost/server/api/mlbbdata/read.php?data_id=" +
          player.preference.mlbbdata_id
      );

      const mlbbdata = JSON.parse(await mlbbdataJSON.text());
      return `
          <div class="player-card">
            <h6>
              ${player.user.username}
              
            </h6>
            <div>
              <span>Primary:</span>
              <span class="badge bg-primary">${player.preference.primaryRole}</span>
            </div>
            <div>
              <span>Secondary:</span>
              <span class="badge bg-secondary">${player.preference.secondaryRole}</span>
            </div>
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
