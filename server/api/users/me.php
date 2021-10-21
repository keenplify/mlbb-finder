<?php
require_once("../../config/db.php");
require_once("../../helpers/globals.php");
$headers = apache_request_headers();

//Decrypts the key and returns the user
if (isset($headers['Authorization'])) {
  list($type, $data) = explode(" ", $headers['Authorization'], 2);
  if (!strcasecmp($type, "Bearer") == 0) {
    echo "Invalid authorization!";
    http_response_code(403);
    return;
  }

  $userId = openssl_decrypt($data, $TOKEN_ALGORITHM, $TOKEN_PASSWORD, 0, $TOKEN_IV);

  if ($userId == false) {
    echo "Bad token!";
    http_response_code(403);
    return;
  }

  $sql = "
    SELECT * FROM tbl_users WHERE user_id=$userId
  ";

  $result = $mysqli->query($sql);

  if (!$result) {
    echo "Token user is invalid!";
    http_response_code(406);
    return;
  }

  echo json_encode($result->fetch_object("User"));
} else {
  echo "Token not found!";
  http_response_code(401);
}
