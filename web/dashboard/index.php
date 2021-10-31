<?php
session_start();
require("../helpers/cURL.php");

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
    
  </head>

  <body>
    <p>Welcome, <?php echo $me->firstname; ?></p>
    <a href="../../server/api/users/logout.php">Logout</a>

    <button onclick="toggle()" id="start_btn">Enqueue</button>
    <button onclick="listUserPreferences()" id="start_btn">Get Preferences</button>
    <div>
      <span>Timer:</span>
      <span id="timer">0</span>
    </div>
  </body>

</html>