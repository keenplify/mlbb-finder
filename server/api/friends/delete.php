<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['friendUserId']) 
) {
  $user_id = filter_var($_POST['createdBy']);
  $friendUserId = filter_var($_POST['friendUserId']);

  $sql = "
  DELETE FROM `tbl_friend` WHERE friendUserId = '$friendUserId';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "Friend deleted successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}