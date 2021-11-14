<?php
require_once("../../config/db.php");
if (isset($_GET['user_id'])) {
  $user_id = filter_var($_GET['user_id']);

  $sql = "
    SELECT * FROM tbl_users WHERE user_id=$user_id
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "User ID is invalid! " . $user_id;
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object());
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}

