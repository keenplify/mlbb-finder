<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['friendUserId']) &&
  isset($_POST['friendId'])
) {
  $user_id = filter_var($_POST['createdBy']);
  $friendUserId = filter_var($_POST['friendUserId']);
  $id = filter_var($_POST['friendId']);
  
  $sql = "
    INSERT INTO `tbl_friend` (friendUserId, createdBy, isAccepted)
    VALUES ('$friendUserId', '$user_id', '$id');
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Friend added successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}