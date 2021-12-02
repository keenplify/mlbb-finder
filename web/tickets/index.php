<?php
  session_start();
  require_once("../helpers/cURL.php");
  require_once("../helpers/authenticate.php");
  require_once("../components/EditTicket.php");
  require_once("../components/TicketCard.php");
  require_once("../helpers/url.php");

  $me = authenticate(false);
  $getAllTickets = CallAPI("GET", "http://localhost/server/api/tickets/getAll.php", false);

  $tickets = json_decode($getAllTickets);
?>

<script>
  const TICKETS = JSON.parse(`<?php echo $getAllTickets; ?>`);
  
  
</script>

<html>
  <head>
    <title>Mobile Legends:Bang Bang Player Finder</title>
    <!---------------------------- LOGO ---------------------------->
    <link rel="shortcut icon" type="text/css" href="../img/Logo.jpg">
    <?php require "../helpers/libraries.php" ?>
    

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/tickets.css">
    
    <!---------------------------- Google Font ---------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">    

    <!------------------------- LOGIC ---------------------------->
    <script src="../js/ticket-logic.js" defer></script>
  </head>
  <body>


  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
  <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container-fluid"> 
                <a href="index.php" class="navbar-brand fs-2">GameBuddies</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navbar">
                <span class="navbar-toggler-icon justify-content-end"></span>
                 </button>
            </div>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav flex-column">

        <div class="time text-center p-3">
              <p class="fs-4 lh-base">
              <span>Timer:</span>
              <span id="timer">0</span>  
              <br>
              <span>Online Users:</span>
              <span id="onlineCount">0</span>
              </p>
        </div>

        <li class="nav-item m-auto w-100">
           <button onclick="toggle()" id="start_btn" class="b1 btn btn-danger w-100 fs-6">ENQUEUE</button>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-5 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/friends/requests.php" class="btn text-white fs-5 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/tickets" class="btn text-white fs-5 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/mlbbdata.php" class="btn text-white fs-5 mx-4">MLBB Accounts</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/server/api/users/logout.php" class="btn text-white fs-5 mx-4">Logout</a>
        </li>
      </ul>
</div>             
</nav>
      </aside>

    <main class="col px-0 flex-grow-1">
 
    <div class="container">
      <h1 class="text-white">Tickets</h1>
      <div class="d-flex flex-row-reverse">
        <div class="btn-group">
          <?php 
            echo EditTicketComponent($me);
          ?>
        </div>
      </div>
      <div class="tickets-container container">
        <div class="row">
          <?php
            foreach($tickets as $ticket) {
              echo TicketComponent($ticket);
            }
          ?>
        </div>
      </div>
    </div>

</main>
</div>
</div>
      


  



    
  </body>
</html>