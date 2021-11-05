const socket = io("http://localhost:8001");
const MESSAGESCONTAINER = document.querySelector("#messages_container");
const MAINCONTAINER = $(".main");

let USER = JSON.parse(_USERJSON);
let LOBBYMESSAGES = [];
let LOBBYMESSAGEAUTHORS = [];

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
  console.log(LOBBYMESSAGEAUTHORS);
  LOBBYMESSAGES.map((e) => {
    const author = LOBBYMESSAGEAUTHORS.find((v) => v.user_id == e.createdBy);
    innerHTML += MessageCardFn(e, author);
  });

  MESSAGESCONTAINER.innerHTML = innerHTML;
  scrollSmoothToBottom(".main");
}

socket.emit("join_lobby", USER, (data) => {
  console.log(data.message_authors);
  LOBBYMESSAGEAUTHORS = [...LOBBYMESSAGEAUTHORS, ...data.message_authors];
  USER = data.__user;

  setMessages(data.messages);
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
