

<div class="addMessageContainer">
<form id="addMessageForm" class="col-8 bg-dark">
  
  <div class="row py-1">
    <div class="col-8">
      <textarea id="newMessageTextArea" name="newMessageTextArea" placeholder="Say something..." class="form-control rounded-0 bg-dark text-white " onkeydown="AutoSubmit()"></textarea>
    </div>
    <div class="col-4">
      <button class="btn btn-success w-100 h-100">
        <span class="oi oi-check"></span>
        Send
      </button>
    </div>
  </div>

</form>
</div>
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