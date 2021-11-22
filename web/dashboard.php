<?php
session_start();
require("./helpers/cURL.php");

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
    <title>Dashboard - Gamebuddies</title>
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

  <body>
    
    <div class="container">
      <div id="alerts"></div>
      <?php require "components\preferences.php";?>
      <a href="mlbbdata.php" class="btn btn-secondary">MLBB Accounts</a>
      <a href="http://localhost/server/api/users/logout.php" class="btn btn-danger">Logout</a>

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>