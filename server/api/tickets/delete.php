<?php
require_once("../../config/db.php");

if (
  isset($_POST['username']) &&
  isset($_POST['title']) &&
  isset($_POST['body']) 
) {
  $createdBy = filter_var($_POST['username']);
  $title = filter_var($_POST['title']);
  $body = filter_var($_POST['body']);
  
  $sql = "
  DELETE FROM `tbl_tickets` WHERE createdBy = '$cretedBy';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "Ticket deleted successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}