<?php
require_once("../components/Badge.php");
require_once("../helpers/mapStatusToBootstrapContext.php");

function TicketComponent($ticket) {
  return '
    <a href="view.php?ticket_id='. $ticket[0] .'" class="card-link">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">'. $ticket[2]. " " . BadgeComponent(mapStatusToBootstrapContext($ticket[4]), $ticket[4]) .'</h5>
          <p class="card-text">'. mb_strimwidth($ticket[3], 0, 100, "...") .'</p>
        </div>
      </div>
    </a>
  ';
}