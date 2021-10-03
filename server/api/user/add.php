<?php
require_once("../../config/db.php");

/* 
  POST api/user/add
  Register User 
*/
if (
  isset($_POST['firstname']) &&
  isset($_POST['lastname']) &&
  isset($_POST['username']) &&
  isset($_POST['password']) &&
  isset($_POST['birthday']) &&
  isset($_POST['email'])
) {
  $firstname = filter_var($_POST['firstname']);
  $lastname = filter_var($_POST['lastname']);
  $username = filter_var($_POST['username']);
  $email = filter_var($_POST['email']);
  $password = filter_var($_POST['password']);
  $birthday = filter_var($_POST['birthday']);

  $hash = password_hash($password, PASSWORD_BCRYPT);

  $sql = "
    INSERT INTO `tbl_users` (firstname, lastname, email, username, password, birthday)
    VALUES ('$firstname', '$lastname', '$email', '$username', '$hash', '$birthday');
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "User added successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}
