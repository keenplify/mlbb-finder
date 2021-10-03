<?php
require_once("../../config/db.php");
require_once("../../helpers/globals.php");

//Decrypts the key and returns the user
if (isset($_COOKIE['token'])) {
  $userId = openssl_decrypt($_COOKIE['token'], $TOKEN_ALGORITHM, $TOKEN_PASSWORD, 0, $TOKEN_IV);

  if ($userId == false) {
    echo "Bad token!";
    http_response_code(403);
    return;
  }

  $sql = "
    SELECT * FROM tbl_users WHERE id=$userId
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "Token user is invalid!";
    http_response_code(406);
    return;
  }

  $response = new stdClass();
  $response->message = "Successful!";
  $response->user = $result->fetch_object('User');
  echo json_encode($response);
} else {
  echo "Token not found!";
  http_response_code(401);
}
