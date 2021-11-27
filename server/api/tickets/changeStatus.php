<?php
require_once("../../config/db.php");

if (
  isset($_POST['ticket_id']) &&
  isset($_POST['status'])
) {
  $ticket_id = filter_var($_POST['ticket_id']);
  $status = filter_var($_POST['status']);
  
  $sql = "
  UPDATE `tbl_tickets` SET status = '$status'
  WHERE ticket_id=$ticket_id;
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