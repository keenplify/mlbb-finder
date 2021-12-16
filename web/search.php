<?php

session_start();
include_once "./helpers/cURL.php";
include_once "./helpers/url.php";
include_once("./components/UserCard.php");
include_once("./components/TicketCard.php");
include_once("./components/Badge.php");
include_once("./helpers/mapStatusToBootstrapContext.php");

$resultJSON = CallAPI("GET", getOrigin_URL()."/server/api/search/searchAll.php?keyword=".$_GET['keyword']);
$resultObject = json_decode($resultJSON);

?>

<html>
  <head>
    <title>Search</title>
    <?php require "./helpers/libraries.php" ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!---------------------------- LOGO ---------------------------->
     <link rel="shortcut icon" type="text/css" href="../img/Logo.jpg">

    <!---------------------------- Bootstrap ---------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

      <!---------------------------- Google Font ---------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">  

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="./css/tickets.css">
  </head>

  <body class="text-white" bgcolor="#2e3548">

  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
  <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container-fluid"> 
                <a href="dashboard.php" class="navbar-brand fs-2">GameBuddies</a>
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

        <?php include "./components/Search.php"?>
        <br>
        
        <li class="nav-item">
        <a href="Profile/view.php?user_id=<?php echo $_SESSION["user"] -> user_id?>" class="btn text-white fs-5 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="friends/requests.php" class="btn text-white fs-5 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="tickets" class="btn text-white fs-5 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="mlbbdata.php" class="btn text-white fs-5 mx-4">MLBB Accounts</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="http://localhost/server/api/users/logout.php" class="btn text-white fs-5 mx-4">Logout</a>
        </li>
      </ul>
</div>             
</nav>
      </aside>

    <main class="col px-0 flex-grow-1 m-md-3">
    <div class="container">
      <h3>Users</h3>
      <?php 
      if (!$resultObject->users) {
        echo "<h5>No users found.</h5>";
      } else foreach ($resultObject->users as $user):?>
        <?php echo UserCard($user, $user->user_id)?>
      <?php endforeach ?>
      <h3>Tickets</h3>
      <?php 
      if (!$resultObject->tickets) {
        echo "<h5>No tickets found.</h5>";
      } else foreach ($resultObject->tickets as $ticket):?>
        <?php echo TicketComponent($ticket, true)?>
      <?php endforeach ?>
      </div>
    </div>
</main>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    

    <!-- Important Scripts! Dont Remove! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>