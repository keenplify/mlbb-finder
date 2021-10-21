<?php
require_once("../../config/db.php");

if (
  isset($_POST['ticket_id'])
) {
  $ticket_id = filter_var($_POST['ticket_id']);
  
  $sql = "
  DELETE FROM `tbl_tickets` WHERE ticket_id = '$ticket_id';
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