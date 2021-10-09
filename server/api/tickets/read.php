<?php
require_once("../../config/db.php");

if (
  isset($_POST['username']) &&
) {
  $createdBy = filter_var($_POST['username']);

  
  $sql = "
    SELECT * FROM `tbl_tickets` WHERE id= '$createdBy'
  ";


  $result = $mysqli->query($sql);

  if (!$result) {
    echo "User is invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object("createdBy"));
} else {
  echo "Ticket not found!";
  http_response_code(401);
}