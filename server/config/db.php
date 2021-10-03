<?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "mlbb_finder";

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
