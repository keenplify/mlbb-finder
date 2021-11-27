<?php
require_once("../../config/db.php");

$sql = "
  SELECT * FROM `tbl_tickets`
  LEFT JOIN `tbl_users`
  ON tbl_tickets.createdBy = tbl_users.user_id
  ORDER BY tbl_tickets.updatedAt DESC
;";

$result = $mysqli->query($sql);

if (!$result) {
  echo "Invalid query!";
  http_response_code(406);
  return;
}

echo json_encode($result->fetch_all());
