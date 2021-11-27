<?php
require_once("../../config/db.php");

if (
  isset($_GET['user1_id']) &&
  isset($_GET['user2_id'])
) {
  $user1_id = filter_var($_GET['user1_id']);
  $user2_id = filter_var($_GET['user2_id']);

  $sql = "
    SELECT * FROM `tbl_friend`
    WHERE (createdBy='$user1_id' AND friendUserId='$user2_id')
    OR (createdBy='$user2_id' AND friendUserId='$user1_id');
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "Invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object());
} else {
  echo "Friend not found!";
  http_response_code(401);
}