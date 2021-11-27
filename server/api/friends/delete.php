<?php
require_once("../../config/db.php");

if (
  isset($_POST['friend_id']) || isset($_GET['friend_id']) 
) {
  $id = filter_var($_POST['friend_id']);
  if (isset($_GET['friend_id'])) $id = filter_var($_GET['friend_id']);

  $sql = "
  DELETE FROM `tbl_friend` WHERE friend_id='$id';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "Friend deleted successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
    if (isset($_GET['redirect'])) header('Location: ' . $_GET['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}