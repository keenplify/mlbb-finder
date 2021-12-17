<?php
require_once("../../config/db.php");

if (
  isset($_POST['user_id']) &&
  isset($_POST['password'])
) {
  $user_id = filter_var($_POST['user_id']);
  $password = filter_var($_POST['password']);

  $hash = password_hash($password, PASSWORD_BCRYPT);

  $sql = "
  UPDATE `tbl_users` SET 
  password ='$hash'
  WHERE user_id = '$user_id';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "User password updated successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}