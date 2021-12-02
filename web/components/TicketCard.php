<?php
require_once("../components/Badge.php");
require_once("../helpers/mapStatusToBootstrapContext.php");
require_once("../helpers/url.php");

function TicketComponent($ticket) {
  return '
  <a href="'. getOrigin_URL() .'/web/tickets/view.php?ticket_id='. $ticket[0] .'"class="card-link">
    <div class="card my-2">
      <div class="card-body">
        <h5 class="card-title">'. $ticket[2]. " " . BadgeComponent(mapStatusToBootstrapContext($ticket[4]), $ticket[4]) .'</h5>
        <p>
          <span>Created By '.$ticket[9].', '. $ticket[8] .'</span>
          <span class="badge badge-info">@'. $ticket[11] .'</span>
        </p>
        <p class="card-text">'. mb_strimwidth($ticket[3], 0, 100, "...") .'</p>
      </div>
      </div>
  </a>
  ';
}