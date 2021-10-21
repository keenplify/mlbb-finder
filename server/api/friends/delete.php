<?php
require_once("../../config/db.php");

if (
  isset($_POST['friend_id']) 
) {
  $id = filter_var($_POST['friend_Id']);

  $sql = "
  DELETE FROM `tbl_friend` WHERE friend_Id = '$id';
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