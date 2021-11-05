<?php
require_once("../../config/db.php");

if (
  isset($_POST['gameMode'])&&
  isset($_POST['primaryRole'])&&
  isset($_POST['secondaryRole'])&&
  isset($_POST['createdBy'])
) {
  $gameMode = filter_var($_POST['gameMode']);
  $primaryRole = filter_var($_POST['primaryRole']);
  $secondaryRole = filter_var($_POST['secondaryRole']);
  $createdBy = filter_var($_POST['createdBy']);
  
  
  $sql = "
    INSERT INTO `tbl_preference` (gameMode, primaryRole, secondaryRole, createdBy)
    VALUES ('$gameMode', '$primaryRole', '$secondaryRole', $createdBy);
  ";


  $res = $mysqli->query($sql);

  if ($res) {
    echo "Preference added successfully";
  } else {
    print_r($mysqli->error);
    http_response_code(400);
  }
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}
