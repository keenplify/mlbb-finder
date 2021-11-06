<?php
require_once("../../config/db.php");

if (
  isset($_POST['data_id'])
) {
  $data_id = filter_var($_POST['data_id']);
  
  $sql = "
  DELETE FROM `tbl_mlbbdata` WHERE data_id = '$data_id';
  ";

  $res = $mysqli->query($sql);

  if ($res) {
    echo "MLBB Data deleted successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(500);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}