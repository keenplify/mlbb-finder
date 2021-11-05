<div id="message_card-${v.message_id}" class="message_card ${USER.user_id == v.createdBy ? 'message_card_you':''}">
  <div class="badge badge-primary author_badge ${USER.user_id == v.createdBy ? 'author_you':''}">
    ${author ? author.firstname + ' ' + author.lastname : v.createdBy}
  </div>
  <div >
    ${v.message}
  </div>
</div>