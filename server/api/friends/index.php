<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['friendUserId']) 
) {
  $user_id = filter_var($_POST['createdBy']);
  $friendUserId = filter_var($_POST['friendUserId']);

  
  $sql = "
    INSERT INTO `tbl_friend` (friendUserId, createdBy, isAccepted)
    VALUES ('$friendUserId', '$user_id', false);
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Friend added successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}
