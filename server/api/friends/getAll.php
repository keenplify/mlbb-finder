<?php
require_once("../../config/db.php");

if (
  isset($_GET['user_id'])
) {
  $createdBy = filter_var($_GET['user_id']);
  $sql = "
    SELECT * FROM `tbl_friend`
    WHERE (createdBy = '$createdBy' AND isAccepted = 1)
    OR (friendUserId = '$createdBy' AND isAccepted = 1)
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "Invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
} else {
  echo "Friend not found!";
  http_response_code(401);
}