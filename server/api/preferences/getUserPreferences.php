<?php
require_once("../../config/db.php");

if (isset($_GET["createdBy"])) {
  $createdBy = filter_var($_GET['createdBy']);

  $sql = "
  SELECT * FROM `tbl_preference` WHERE createdBy = $createdBy;
  ";

  $res = $mysqli->query($sql);



  if ($res) {
    echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}