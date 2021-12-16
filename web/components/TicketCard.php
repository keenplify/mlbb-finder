<?php

function TicketComponent($ticket, $isAssoc=false) {
  return '
  <a href="'. getOrigin_URL() .'/web/tickets/view.php?ticket_id='. ($isAssoc ? $ticket->ticket_id : $ticket[0]).'"class="card-link text-decoration-none">
    <div class="card Cardo my-2 text-white">
      <div class="card-body">
        <h5 class="card-title">'. ($isAssoc ? $ticket->title : $ticket[2]) . " " . 
        BadgeComponent(
          mapStatusToBootstrapContext(($isAssoc ? $ticket->status : $ticket[4])),
          ($isAssoc ? $ticket->status : $ticket[4])
         ) .'</h5>
        <p>
          <span>Created By '.($isAssoc ? $ticket->lastname : $ticket[9]).', '. ($isAssoc ? $ticket->firstname : $ticket[8]) .'</span>
          <span class="badge badge-info">@'. ($isAssoc ? $ticket->username : $ticket[11]) .'</span>
        </p>
        <p class="card-text">'. mb_strimwidth(($isAssoc ? $ticket->body : $ticket[3]), 0, 100, "...") .'</p>
      </div>
      </div>
  </a>
  ';
}