<?php
require_once("../../config/db.php");

if (
  isset($_POST['created_by']) &&
  isset($_POST['title']) &&
  isset($_POST['body']) 
) {
  $createdBy = filter_var($_POST['created_by']);
  $title = filter_var($_POST['title']);
  $body = filter_var($_POST['body']);
  
  $sql = "
    INSERT INTO `tbl_tickets` (createdBy, title, body)
    VALUES ('$createdBy', '$title', '$body');
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Ticket added successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}

