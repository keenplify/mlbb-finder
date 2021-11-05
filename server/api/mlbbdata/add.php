<?php
require_once("../../config/db.php");

if (
  isset($_POST['createdBy']) &&
  isset($_POST['mlid']) &&
  isset($_POST['ign']) 
) {
  $createdBy = filter_var($_POST['createdBy']);
  $mlid = filter_var($_POST['mlid']);
  $ign = filter_var($_POST['ign']);
  
  $sql = "
    INSERT INTO `tbl_mlbbdata` (createdBy, mlid, ign)
    VALUES ('$createdBy', '$mlid', '$ign');
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "mlbbdata added successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}

