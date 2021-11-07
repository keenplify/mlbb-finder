<?php
require_once("../../config/db.php");

if (
    isset($_POST['data_id']) &&
    isset($_POST['mlid']) &&
    isset($_POST['ign'])
) {
    $data_id = filter_var($_POST['data_id']);
    $mlid = filter_var($_POST['mlid']);
    $ign = filter_var($_POST['ign']);

    $sql = "UPDATE `tbl_mlbbdata` SET `mlid`='$mlid', `ign`='$ign' WHERE `data_id`=$data_id";

    $result = $mysqli->query($sql);

    if ($result) {
        echo "MLBB Data updated successfully";
    } else {
        print_r($mysqli->error);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}