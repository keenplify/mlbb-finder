<?php
require_once("../../config/db.php");

if (
  isset($_POST['user_id']) &&
  isset($_POST['email']) &&
  isset($_POST['firstname']) &&
  isset($_POST['lastname']) 
) {
  $user_id = filter_var($_POST['user_id']);
  $email = filter_var($_POST['email']);
  $firstname = filter_var($_POST['firstname']);
  $lastname = filter_var($_POST['lastname']);

  $sql = "
  UPDATE `tbl_users` SET 
  email ='$email',
  firstname ='$firstname',
  lastname ='$lastname'
  WHERE user_id = '$user_id';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "User updated successfully";
    if (isset($_POST['redirect'])) header('Location: ' . $_POST['redirect']);
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}