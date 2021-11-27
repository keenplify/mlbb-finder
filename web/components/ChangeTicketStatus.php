<?php
require_once("../components/Badge.php");
require_once("../helpers/mapStatusToBootstrapContext.php");
require_once("../helpers/url.php");

function ChangeTicketStatusComponent($ticket) {
  return '
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changeTicketStatusModal">
      CHANGE STATUS
    </button>

    <!-- Modal -->
    <div class="modal fade" id="changeTicketStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeTicketStatusModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changeTicketStatusModalLabel">Change Ticket Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="'. getOrigin_URL() .'/server/api/tickets/changeStatus.php">
            <div class="modal-body">
              <p>Current status: '. BadgeComponent(mapStatusToBootstrapContext($ticket->status), $ticket->status) .'</p>
              <label for="status">Change status to:</label>
              <input type="hidden" name="ticket_id" value="'. $ticket->ticket_id .'">
              <input type="hidden" name="redirect" value="'. getFull_URL() .'">
              <select name="status" id="status">
                <option value="OPEN">OPEN</option>
                <option value="PENDING">PENDING</option>
                <option value="RESOLVED">RESOLVED</option>
                <option value="CLOSED">CLOSED</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  ';
}