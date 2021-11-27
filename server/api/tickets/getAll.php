<?php
require_once("../../config/db.php");

$sql = "
  SELECT * FROM `tbl_tickets`
  ORDER BY updatedAt DESC
;";

$result = $mysqli->query($sql);

if (!$result) {
  echo "User is invalid!";
  http_response_code(406);
  return;
}

echo json_encode($result->fetch_all());
