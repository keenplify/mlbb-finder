<?php
require_once("../../config/db.php");

if (
  isset($_POST['preference_id']) 
) {
  $preference_id = filter_var($_POST['preference_id']);

  $sql = "
  DELETE FROM `tbl_preference` WHERE preference_id = '$preference_id';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "Preference deleted successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}
