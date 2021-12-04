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
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!---------------------------- Bootstrap ---------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/tickets.css">
    
    <!---------------------------- Google Font ---------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">    

    <!------------------------- LOGIC ---------------------------->
    <script src="../js/ticket-logic.js" defer></script>

    <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
  </head>
  <body>


  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
  <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container-fluid"> 
                <a href="../dashboard.php" class="navbar-brand fs-2">GameBuddies</a>
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
        <a href="<?php echo getOrigin_URL(); ?>/web/Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-6 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/friends/requests.php" class="btn text-white fs-6 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/tickets" class="btn text-white fs-6 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/mlbbdata.php" class="btn text-white fs-6 mx-4">MLBB Accounts</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/server/api/users/logout.php" class="btn text-white fs-6 mx-4">Logout</a>
        </li>
      </ul>
</div>             
</nav>
      </aside>

    <main class="col px-0 flex-grow-1">
 
    <div class="header container " data-aos="fade-up">
    <h1 class="text-white text-center display-4 py-2">TICKETS</h1>
      <p class="p2 text-white text-center  col-md-10 m-auto py-2">Tickets provide this support throught information, assitance, and creating a trusting environment.  We must take care of the user by listening to the complaint, and resolving it, to ensure a happy user.</p> 
</div>


    <div class="container" data-aos="fade-down">
    
      <div class="d-flex justify-content-center" >
        <div class="btn btn-lg py-1">
          <?php 
            echo EditTicketComponent($me);
          ?>  
        </div>
      </div>
      <div class="tickets-container container ">
        <div class="row">
          <?php
            foreach($tickets as $ticket) {
              echo '<div class="col-md-6">';
              echo TicketComponent($ticket);
              echo '</div>';
            }
          ?>
        </div>
      </div>
    </div>

</main>
</div>
</div>
      


  
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    
  </body>
</html>