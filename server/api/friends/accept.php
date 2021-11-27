<?php
require_once("../../config/db.php");

if (
  isset($_GET['friend_id'])
) {
  $id = filter_var($_GET['friend_id']);
  
  $sql = "
    UPDATE `tbl_friend` SET isAccepted = true WHERE friend_id = '$id';
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Friend added successfully";
     if (isset($_GET['redirect'])) header('Location: ' . $_GET['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}