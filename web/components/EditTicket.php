<?php
require_once("../helpers/url.php");

function EditTicketComponent($me, $ticket=false) {
  $modalTitle = "Add Ticket";
  $submitText = "Add Ticket";
  $title = "";
  $body = "";
  $method = "ADD";
  $formAction = getOrigin_URL() . '/server/api/tickets/index.php';

  // If ticket is present, set to edit mode
  if (is_object($ticket)) {
     $title = $ticket->title;
     $body = $ticket->body;
     $submitText = "Save changes";
     $modalTitle = "Edit Ticket";
     $method = "EDIT";
     $formAction = getOrigin_URL() . '/server/api/tickets/update.php';
  }
  return '
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTicketModal">
      '. $method .'
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title" id="editTicketModalLabel">'. $modalTitle .'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="bg-white rounded">&times;</span>
            </button>
          </div>
          <form method="POST" action="'. $formAction .'">
            <div class="modal-body">
              <div class="form-group">
                <label for="title">Ticket Title</label>
                <input type="hidden" name="created_by" value="'. $me->user_id .'">
                <input type="hidden" name="redirect" value="'. getFull_URL() .'">
                <input type="text" class="form-control" aria-describedby="titleHelp" id="title" name="title" placeholder="Enter title" value="'. $title .'">
                <small id="titleHelp" class="form-text text-muted">Please use a title that explains well your concerns.</small>
              </div>
              <div class="form-group">
                <label for="body">Ticket Body</label>
                <textarea class="form-control" id="body" name="body" rows="8" placeholder="Enter your concern..">'. $body .'</textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">'. $submitText .'</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  ';
}