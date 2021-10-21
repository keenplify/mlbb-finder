<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['title']) &&
  isset($_POST['body']) 
) {
  $createdBy = filter_var($_POST['createdBy']);
  $title = filter_var($_POST['title']);
  $body = filter_var($_POST['body']);
  
  $sql = "
    INSERT INTO `tbl_tickets` (createdBy, title, body)
    VALUES ('$createdBy', '$title', '$body');
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Ticket added successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}

