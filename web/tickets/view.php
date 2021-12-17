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
    <title><?php echo mb_strimwidth($ticket->title, 0, 20, "...")?> - Mobile Legends: Bang Bang Player Finder</title>
    <?php require "../helpers/libraries.php" ?>

    <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
     <!---------------------------- LOGO ---------------------------->
     <link rel="shortcut icon" type="text/css" href="../img/Logo.jpg">

     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/tickets.css">
   
  <!---------------------------- Bootstrap ---------------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!------------------------- LOGIC ---------------------------->
    <script src="../js/ticket-logic.js" defer></script>


     <!---------------------------- Google Font ---------------------------->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">    

  </head>
  <body class="bg2 text-white ">



  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container"> 
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
           <button onclick="toggle()" id="start_btn" class="b1 btn btn-danger w-100 fs-6" disabled>ENQUEUE</button>
        </li>
        <br>

        <?php include "../components/Search.php"?>
        <br>
        
        <li class="nav-item">
        <a href="../Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-6 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="../friends/requests.php" class="btn text-white fs-6 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="../tickets" class="btn text-white fs-6 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="../mlbbdata.php" class="btn text-white fs-6 mx-4">MLBB Accounts</a>
        </li>
        <br>

        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/settings.php" class="btn text-white fs-6 mx-4">Settings</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="http://localhost/server/api/users/logout.php" class="btn text-white fs-6 mx-4">Logout</a>
        </li>
      </ul>
</div>      
</nav>
      </aside>

    <main class="col px-0 flex-grow-1 text-white">
 
    <div class="container col-md-11">
      <div class="d-flex flex-row-reverse">
        <div class="btn-lg btn-group" data-aos="fade-up">
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
        
      <div class="container box bg-dark p-5" data-aos="fade-down">
        <h2 class="py-2"> 
          <?php echo $ticket->title;?>
          <?php
            $context = mapStatusToBootstrapContext($ticket->status);
            echo BadgeComponent($context, $ticket->status);
          ?>
        </h2>
        <a class="text-decoration-none fs-4 text-white awut" href="<?php echo getOrigin_URL()?>/web/profile/view.php?user_id=<?php echo $ticket->user_id ?>">
          <span>Created By <?php echo $ticket->lastname?>, <?php echo $ticket->firstname?></span>
          <span class="badge badge-info">@<?php echo $ticket -> username ?></span>
        </a>
        <p> <?php echo $ticket->body;?> </p>
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
