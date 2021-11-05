
<form id="addMessageForm">
  <div class="row">
    <div class="col-10">
      <textarea id="newMessageTextArea" name="newMessageTextArea" placeholder="Say something..." class="form-control rounded-0" onkeydown="AutoSubmit()"></textarea>
    </div>
    <div class="col-2">
      <button class="btn btn-success w-100 h-100">
        <span class="oi oi-check"></span>
        Send
      </button>
    </div>
  </div>
</form>

<script defer>
  const ADDMESSAGEFORM = document.querySelector("#addMessageForm");
  const ADDMESSAGE_TEXTAREA = document.querySelector("#newMessageTextArea");

  function Send() {
    socket.emit("add_message", ADDMESSAGE_TEXTAREA.value, USER, (data) => {
      addMessage(data)
      
    })
    ADDMESSAGE_TEXTAREA.value = "";
  }

  ADDMESSAGEFORM.onsubmit = (event => {
    event.preventDefault();
    
    Send()
  })

  function AutoSubmit(e) {
      if ( (window.event ? event.keyCode : e.which) == 13) { 
        event.preventDefault();
        Send();
      }
  }
</script>