<?php


function TicketComponent($ticket) {
  return '
    <a href="view.php?ticket_id='. $ticket[0] .'" class="card-link">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">'. $ticket[2] .'</h5>
          <p class="card-text">'. mb_strimwidth($ticket[3], 0, 100, "...") .'</p>
        </div>
      </div>
    </a>
  ';
}