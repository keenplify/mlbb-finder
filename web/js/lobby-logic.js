const socket = io("http://localhost:8001");
const MESSAGESCONTAINER = document.querySelector("#messages_container");
const MAINCONTAINER = $(".main");

let USER = JSON.parse(_USERJSON);
let LOBBYMESSAGES = [];
let LOBBYMESSAGEAUTHORS = [];
let LOBBY;
var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
  }
  return false;
};


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
  document.querySelector("#gamemode-text").innerHTML = LOBBY.gamemode;
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
      const friendshipJSON = await fetch(
        "http://localhost/server/api/friends/getFriendship.php?user1_id=" +
         user.user_id + "&user2_id=" + USER.user_id
      )
      const friendship = JSON.parse(await friendshipJSON.text());
      console.log (friendship)

      let backgroundURL = "";

      if (playerRole == "Tank")
        backgroundURL =
          "img/TANK.jpg";
        else if (playerRole == "Marksman")
          backgroundURL = 
          "img/MARKSMAN.jpg";  
          else if (playerRole == "Assassin")
          backgroundURL = 
          "img/ASSASSIN.jpg"; 
          else if (playerRole == "Mage")
          backgroundURL = 
          "img/MAGE.jpg";  
          else if (playerRole == "Fighter")
          backgroundURL = 
          "img/FIGHTER.jpg";  
          else if (playerRole == "Support")
          backgroundURL = 
          "img/SUPPORT.jpg";  

      return `
         <!---------------------------- Font Awosome ---------------------------->
    <script src="https://kit.fontawesome.com/d75cefc660.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="css/lobby.css">
          <div style="background: url('${backgroundURL}')" class="player-card" >
            <h6>
              <a href="http://localhost/web/profile/view.php?user_id=${user.user_id}" class="link-light text-decoration-none" >${user.username}</a>
              <span class="badge bg-primary">${playerRole}</span>
            </h6>
            <div>
              <span>IGN: <span class="badge bg-success">${mlbbdata.ign}</span></span><br>
              <span>MLID: <span class="badge bg-danger">${mlbbdata.mlid}</span></span>
            </div>
            <div>

            <form method="POST" action="${friendship?"http://localhost/server/api/friends/delete.php":"http://localhost/server/api/friends/index.php"}">
            ${friendship?`<input type="hidden" name="friend_id" value="${friendship.friend_id}">`:""}
             


          <input type="hidden" name="friendUserId" value="${user.user_id}">
          <input type="hidden" name="createdBy" value="${USER.user_id}">
          <input type="hidden" name="redirect" value="${window.location.href}">
          ${
            user.user_id == USER.user_id?`
            
            <button class="btn btn-dark btn-sm" type="submit" diasbled>
            <span class="text-center text-white"> You</span>
            </button>
            
            `
            :!friendship?`
            <span class="text-center">Add Friend</span>
            <button class="btn btn-primary btn-sm" type="submit">
            <span class="oi oi-plus mx-1"><span class="text-center"></span></span>
            </button>
            `
            :friendship?.isAccepted == "1"
            ?`
            <span class="text-center">Friend</span>
            <button class="btn btn-success btn-sm">
            <span class="oi oi-check mx-1"></span>
            </button>
            `
            :`
            <span class="text-center"> Friend Request</span>
            <button class="btn btn-secondary btn-sm">
            <span class="oi oi-ellipses mx-1"></span>
            </button>
            
            `
           
          }

        </form>

            </div>
          </div>
        `;
    })
  );

  document.querySelector("#users-container").innerHTML = data.join("");
}
