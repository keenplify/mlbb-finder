<?php
require_once("../../config/db.php");

if (
  isset($_POST['friend_id'])
) {
  $id = filter_var($_POST['friend_id']);
  
  $sql = "
    UPDATE `tbl_friend` SET isAccepted = true WHERE friend_id = '$id';
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