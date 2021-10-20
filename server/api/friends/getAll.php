<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy'])
) {
  $user_id = filter_var($_POST['createdBy']);

  $sql = "
    SELECT * FROM `tbl_friend` WHERE createdBy = '$user_id'
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "User is invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object("createdBy"));
} else {
  echo "Friend not found!";
  http_response_code(401);
}