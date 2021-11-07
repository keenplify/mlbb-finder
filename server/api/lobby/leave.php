<?php
require_once("../../config/db.php");
session_start();
$user_id = $_SESSION['user']->user_id;

$sql = "
    UPDATE tbl_users SET currentLobbyUUID=NULL WHERE user_id=$user_id;
  ";

$result = $mysqli->query($sql);

if (!$result) {
  echo "User ID is invalid! " . $userId;
  http_response_code(406);
  return;
}

header("Location: http://localhost/web/dashboard.php");
