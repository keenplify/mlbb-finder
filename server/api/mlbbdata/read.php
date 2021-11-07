<?php
require_once("../../config/db.php");

if (isset($_GET['data_id'])) {
    $data_id = filter_var($_GET['data_id']);

    $sql = "SELECT * FROM `tbl_mlbbdata` WHERE data_id = '$data_id'";

    $result = $mysqli->query($sql);

    if (!$result) {
        echo "Data ID is invalid!";
        http_response_code(406);
        return;
    }

    echo json_encode($result->fetch_object());
} else {
    echo "Data ID not found!";
    http_response_code(401);
}