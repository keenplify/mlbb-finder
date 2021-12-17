<?php

session_start();
include_once "./helpers/cURL.php";
include_once "./helpers/url.php";
include_once("./components/UserCard.php");
include_once("./components/TicketCard.php");
include_once("./components/Badge.php");
include_once("./helpers/mapStatusToBootstrapContext.php");

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

    <script>
      function onPasswordChange() {
        const password = document.querySelector('input[name=password]');
        const confirm = document.querySelector('input[name=confirm]');
        if (confirm.value === password.value) {
          confirm.setCustomValidity('');
        } else {
          confirm.setCustomValidity('Passwords do not match');
        }
      }
    </script>
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
        <a href="<?php echo getOrigin_URL(); ?>/web/settings.php" class="btn text-white fs-5 mx-4">Settings</a>
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
      <h3>User Settings</h3>
      <p>
        <a class="btn btn-link link-light" data-toggle="collapse" href="#editUserCollapse" role="button" aria-expanded="true" aria-controls="editUserCollapse">
          Show/Hide Edit User
        </a>
      </p>
      <div class="collapse show" id="editUserCollapse" aria-expanded="true" >
        <div class="card card-body">
          <h4>Edit User Details</h4>
          <form method="POST" action="<?php echo getOrigin_URL() ?>/server/api/users/update.php">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user"]->user_id?>">
            <input type="hidden" name="redirect" value="<?php echo getFull_URL() ?>">
            <div class="mb-3">
              <label>Username:</label>
              <input class="form-control" type="text" name="username" value="<?php echo $_SESSION["user"]->username ?>" placeholder="Enter Username">
            </div>
            <div class="mb-3">
              <label>Email:</label>
              <input class="form-control" type="email" name="email" value="<?php echo $_SESSION["user"]->email ?>" placeholder="Enter Email">
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label>First Name:</label>
                <input class="form-control" type="text" name="firstname" value="<?php echo $_SESSION["user"]->firstname ?>" placeholder="Enter First Name">
              </div>
              <div class="col-md-6">
                <label>Last Name:</label>
                <input class="form-control" type="text" name="lastname" value="<?php echo $_SESSION["user"]->lastname ?>" placeholder="Enter Last Name">
              </div>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Edit User</button>
            </div>
          </form>
        </div>
      </div>
      <p>
        <a class="btn btn-link link-light" data-toggle="collapse" href="#editPasswordCollapse" role="button" aria-expanded="true" aria-controls="editPasswordCollapse">
          Show/Hide Change Password
        </a>
      </p>
      <div class="collapse show" id="editPasswordCollapse" aria-expanded="true">
        <div class="card card-body">
          <h4>Edit User Password</h4>
          <form method="POST" action="<?php echo getOrigin_URL() ?>/server/api/users/updatePassword.php">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user"]->user_id?>">
            <input type="hidden" name="redirect" value="<?php echo getFull_URL() ?>">
            <div class="mb-3">
              <label>Password:</label>
              <input class="form-control" type="password" id="password" name="password" placeholder="Enter Password" onchange="onPasswordChange()" required>
            </div>
            <div class="mb-3">
              <label>Confirm Password:</label>
              <input class="form-control" type="password" name="confirm" id="confirm" placeholder="Confirm Password" onchange="onPasswordChange()" required>
            </div>
            <span id="message"></span>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
          </form>
        </div>
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