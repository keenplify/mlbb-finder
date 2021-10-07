<?php
require("../helpers/cURL.php");

$me = false;
$result = false;

// Check if token is valid
if (isset($_COOKIE["token"])) {
  $token = $_COOKIE["token"];
  $result = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
    "Authorization: Bearer " . $token
  ));

  if ($result) {
    $me = json_decode($result);
  } else {
    header('Location: /');
  }
}

?>

<html>

<head>
  <title>Dashboard - Gamebuddies</title>
</head>

<body>
  <p>Welcome, <?php echo $me->firstname; ?></p>
  <a href="../../server/api/users/logout.php">Logout</a>
</body>

</html>