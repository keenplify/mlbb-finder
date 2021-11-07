<?php
require_once("../../config/db.php");

if (isset($_GET['createdBy'])) {
    $createdBy = filter_var($_GET['createdBy']);

    $sql = "SELECT * FROM `tbl_mlbbdata` WHERE createdBy=$createdBy";

    $result = $mysqli->query($sql);

    if (!$result) {
        echo "CreatedBy is invalid!";
        http_response_code(406);
        return;
    }

    echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
} else {
    echo "Data not found!";
    http_response_code(401);
}