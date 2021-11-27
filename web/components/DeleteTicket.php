<?php
require_once("../helpers/url.php");

function DeleteTicketComponent($ticket) {
  return '
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTicketModal">
      DELETE
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteTicketModal" tabindex="-1" role="dialog" aria-labelledby="deleteTicketModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteTicketModalLabel">Delete Ticket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure to delete this ticket?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form method="POST" action="'. getOrigin_URL() .'/server/api/tickets/delete.php">
              <input type="hidden" name="ticket_id" value="'. $ticket -> ticket_id .'"/>
              <input type="hidden" name="redirect" value="'. getOrigin_URL() .'/web/tickets"/>
              <button type="submit" class="btn btn-danger" id="deleteTicketButton">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  ';
}