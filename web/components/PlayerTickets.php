<?php
  require_once("../helpers/cURL.php");
  require_once("../components/TicketCard.php");

  $getUserTickets = CallAPI("GET", "http://localhost/server/api/tickets/getUserTickets.php?createdBy=".$_GET['user_id'], false);
  $userTickets = json_decode($getUserTickets);
?>


<div>
  <h4 class="display-6"><?php echo $user->firstname. ' '.$user->lastname?>'s TICKETS</h4>
  <?php
    foreach($userTickets as $ticket) {
      echo TicketComponent($ticket);
    }
  ?>
</div>