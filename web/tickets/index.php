<?php
  session_start();
  require_once("../helpers/cURL.php");
  require_once("../helpers/authenticate.php");
  require_once("../components/TicketCard.php");
  require_once("../components/EditTicket.php");

  $me = authenticate(false);
  $getAllTickets = CallAPI("GET", "http://localhost/server/api/tickets/getAll.php", false);
  $tickets = json_decode($getAllTickets);
?>

<script>
  const TICKETS = JSON.parse(`<?php echo $getAllTickets; ?>`);
  
  
</script>

<html>
  <head>
    <title>Tickets - Gamebuddies</title>
    <?php require "../helpers/libraries.php" ?>

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/tickets.css">
    
    <!------------------------- LOGIC ---------------------------->
    <script src="../js/ticket-logic.js" defer></script>
  </head>
  <body>
    <div class="container">
      <h1>Tickets</h1>
      <div class="d-flex flex-row-reverse">
        <div class="btn-group">
          <?php 
            echo EditTicketComponent($me);
          ?>
        </div>
      </div>
      <div class="tickets-container">
        <?php
          foreach($tickets as $ticket) {
            echo TicketComponent($ticket);
          }
        ?>
      </div>
    </div>
  </body>
</html>