<?php
  session_start();
  require_once("../helpers/cURL.php");
  require_once("../helpers/mapStatusToBootstrapContext.php");
  require_once("../helpers/authenticate.php");
  require_once("../helpers/url.php");

  require_once("../components/Badge.php");
  require_once("../components/DeleteTicket.php");
  require_once("../components/EditTicket.php");
  require_once("../components/ChangeTicketStatus.php");
  
  $me = authenticate(false);

  if (isset($_GET['ticket_id'])) {
    $getTicket = CallAPI("GET", "http://localhost/server/api/tickets/read.php", array(
      "ticket_id" => $_GET['ticket_id']
    ));

    $ticket = json_decode($getTicket);

    if (!isset($ticket)) {
      echo "Ticket not found.";
      http_response_code(404);
      return;
    } 

  } else {
    header("location: ./");
  }
?>

<html>
  <head>
    <title><?php echo mb_strimwidth($ticket->title, 0, 20, "...")?> - Gamebuddies</title>
    <?php require "../helpers/libraries.php" ?>

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/tickets.css">

    <!------------------------- LOGIC ---------------------------->
    <script src="../js/ticket-logic.js" defer></script>
  </head>
  <body>
    <div class="container">
      <div class="d-flex flex-row-reverse">
        <div class="btn-group">
          <?php 
            if ($me->user_id == $ticket->createdBy) echo EditTicketComponent($me, $ticket);
          ?>
          <?php
            if ($me->type == "ADMIN") echo ChangeTicketStatusComponent($ticket);
          ?>
          <?php
            if ($me->type == "ADMIN" || $me->user_id == $ticket->createdBy) echo DeleteTicketComponent($ticket);
          ?>
        </div>
      </div>
        
      <div>
        <h3> 
          <?php echo $ticket->title;?>
          <?php
            $context = mapStatusToBootstrapContext($ticket->status);
            echo BadgeComponent($context, $ticket->status);
          ?>
        </h3>
        <a href="<?php echo getOrigin_URL()?>/profile/view.php?user_id=<?php echo $ticket->user_id ?>">
          <span>Created By <?php echo $ticket->lastname?>, <?php echo $ticket->firstname?></span>
          <span class="badge badge-info">@<?php echo $ticket -> username ?></span>
        </a>
        <p> <?php echo $ticket->body;?> </p>
      </div>
    </div>
  </body>
</html>
