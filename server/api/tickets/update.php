<?php
require_once("../../config/db.php");

if (
  isset($_POST['created_by']) &&
  isset($_POST['title']) &&
  isset($_POST['body']) 
) {
  $createdBy = filter_var($_POST['created_by']);
  $title = filter_var($_POST['title']);
  $body = $_POST['body'];
  
  $sql = "
  UPDATE `tbl_tickets` SET title = '$title', body = '$body'
  WHERE createdBy = '$createdBy';
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Ticket updated successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}