<?php
session_start();
require("./helpers/cURL.php");
require("./helpers/url.php");

$result = false;
$me = false;

if (isset($_COOKIE["token"])) {
  $result = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
    "Authorization: Bearer " . $_COOKIE["token"]
  ));
  

  if (!$result) {
    header('Location: http://localhost/web/index.php');
  } else {
    $me = json_decode($result);
    $_SESSION["user"] = $me;
  }
} else {
  header('Location: http://localhost/web/index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>
  <title>Mobile Legends: Bang Bang Player Finder Web Application  </title>
  <!---------------------------- CSS---------------------------->
  <link rel="stylesheet" type="text/css" href="css/Dashboard.css">
  

  <!---------------------------- Google Font ---------------------------->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">    

<!---------------------------- Font Awosome ---------------------------->
<script src="https://kit.fontawesome.com/d75cefc660.js" crossorigin="anonymous"></script>


  <!---------------------------- LOGO ---------------------------->
  <link rel="shortcut icon" type="text/css" href="img/Logo.jpg">
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQUERY -->
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/socket.io.min.js"></script>
    <script>
      // FOR PHP-JAVASCRIPT CONNECTIONS
      var _USERJSON = `<?php print json_encode($me)?>`;
    </script>
    <script src="./js/queue-logic.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./img/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  </head>

  <body class="text-white">
    

    <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container"> 
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
        
        <li class="nav-item li-hover li-dark ">
        <a href="Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-6 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="friends/requests.php" class="btn text-white fs-6 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="tickets" class="btn text-white fs-6 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="mlbbdata.php" class="btn text-white fs-6 mx-4">MLBB Accounts</a>
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

    <main class="col px-0 flex-grow-1 mt-3">
 
     <div class="container">
  <div id="alerts"></div> 
  
</div>

<div class="container-fluid">
  <div class="col-lg-10 mx-auto">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/SNt5S4-1577359292846.jpg" class="d-block w-100" style="opacity: 0.5;">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-4">MOBILE LEGENDS: BANG BANG PLAYER FINDER</h5>
        <p class="fs-5">With Mobile Legends: Bang Bang Player Finder, you can make friends from nearby.</p>
      </div>
    </div>
  
</div>
</div>


            <?php require "components\preferences.php";?>
    

</main>
      
    </div>
    
</div>
  



  


    <!-- Important Scripts! Dont Remove! -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>