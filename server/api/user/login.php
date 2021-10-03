<?php

require_once("../../helpers/globals.php");
require_once("../../config/db.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = filter_var($_POST['username']);
  $password = filter_var($_POST['password']);

  $sql = "
    SELECT * FROM tbl_users WHERE username='$username'
  ";

  $results = $mysqli->query($sql);

  if (!mysqli_num_rows($results) > 0) { // If username is found,
    echo "Username not found!";
    http_response_code(403);
    return;
  }

  $user = $results->fetch_object('User');

  if (!password_verify($password, $user->password)) { //Check if password is right
    echo "Wrong password!";
    http_response_code(403);
    return;
  }
  $token = openssl_encrypt($user->id, $TOKEN_ALGORITHM, $TOKEN_PASSWORD, 0, $TOKEN_IV);
  setcookie('token', $token, time() + 60 * 60 * 24 * 7, '/'); //Cookie expires after 7 days

  $response = new stdClass();
  $response->message = "Successful!";
  $response->user = $user;

  //Redirect if `redirect` is present
  if (isset($_GET['redirect'])) {
    $redirect = $_GET['redirect'];
    header("Location: $redirect");
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}
