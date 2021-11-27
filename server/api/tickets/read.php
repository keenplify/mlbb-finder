<?php
require_once("../../config/db.php");

if (
  isset($_GET['ticket_id'])
) {
  $ticket_id = filter_var($_GET['ticket_id']);

  
  $sql = "
    SELECT *
    FROM `tbl_tickets`
    LEFT JOIN tbl_users
    ON tbl_tickets.createdBy = tbl_users.user_id
    WHERE tbl_tickets.ticket_id=$ticket_id
  ";


  $result = $mysqli->query($sql);

  if (!$result) {
    echo "User is invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object());
} else {
  echo "No ticket_id received!";
  http_response_code(401);
}