<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['friendUserId']) 
) {
  $createdBy = filter_var($_POST['createdBy']);
  $friendUserId = filter_var($_POST['friendUserId']);
  
  
  $sql = "
    INSERT INTO `tbl_friend` (friendUserId, createdBy, isAccepted)
    VALUES ('$friendUserId', '$createdBy', false);
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
