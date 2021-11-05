<?php
session_start();
require("../helpers/cURL.php");

if (!isset($_SESSION["user"])) {
  header('Location: ../Login.php');;
  return;
}

$me = $_SESSION["user"];

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Dashboard - Gamebuddies</title>
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <!-- JQUERY -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/socket.io.min.js"></script>
    <script>
      // FOR PHP-JAVASCRIPT CONNECTIONS
      var _USERJSON = `<?php print json_encode($me)?>`;
    </script>
    <script src="../js/queue-logic.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../img/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  </head>

  <body>
    
    <div class="container">
      <?php require "components\preferences.php";?>
    
      <a href="../../server/api/users/logout.php" class="btn btn-danger">Logout</a>

      <button onclick="toggle()" id="start_btn" class="btn btn-primary">Enqueue</button>
      <p>
        <span>Timer:</span>
        <span id="timer">0</span>
        
      </p>
      <p>
        <span>Online Users:</span>
        <span id="onlineCount">0</span>
      </p>
    </div>

    <!-- Important Scripts! Dont Remove! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>