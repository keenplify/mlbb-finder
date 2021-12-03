<?php
session_start();
require("helpers/cURL.php");

if (!isset($_SESSION["user"])) {
  header('Location: http://localhost/web/Login.php');;
  return;
}

$me = $_SESSION["user"];

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Mobile Legends: Bang Bang Player Finder</title>
      <!---------------------------- LOGO ---------------------------->
      <link rel="shortcut icon" type="text/css" href="img/Logo.jpg">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />

<!---------------------------- Bootstrap ---------------------------->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <!---------------------------- CSS---------------------------->
   <link rel="stylesheet" type="text/css" href="css/lobby.css">
  
   <!---------------------------- Google Font---------------------------->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lora&family=Oswald:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">


    <!-- JQUERY -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/socket.io.min.js"></script>
    <script>
      // FOR PHP-JAVASCRIPT CONNECTIONS
      var _USERJSON = `<?php print json_encode($me)?>`;
      const MessageCardFn = (v, author) => `<?php require("./components/Messagecard.php")?>`;
    </script>
    <script src="js/lobby-logic.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="img/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link href="css/lobby.css" rel="stylesheet">
  </head>

  <body class="text-white">

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
        
        <li class="nav-item">
        <a href="Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-5 mx-4">Profile</a>
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

    <main class="col px-0 flex-grow-1">
 
    <div class="container">
      <div class="main row">
        <div class="col-md-4 p-2">
        </div>
        <div class="col-md-4  lobby-details py-1 ">
          <p class="title1 text-center fs-4 ">
            LOBBY USERS
          <br>
            <span>GAMEMODE:</span>
            <span id="gamemode-text"></span>
          </p>
          <div id="users-container" ></div>
        </div>

        <div class="col-md-8 chat text-black bg-dark">
          <div id="messages_container" class="messages_container"></div>
        </div>
      </div>
      <div class="row addMessageRow">
        <?php require("./components/AddMessageForm.php");?>
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