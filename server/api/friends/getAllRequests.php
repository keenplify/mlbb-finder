<?php
require_once("../../config/db.php");

if (
  isset($_GET['user_id'])
) {
  $user_id = filter_var($_GET['user_id']);
  
  $sql = "
    SELECT * FROM `tbl_friend`
    LEFT JOIN `tbl_users`
    ON tbl_users.user_id = tbl_friend.friendUserId
    WHERE isAccepted = 0 AND friendUserId='$user_id'
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