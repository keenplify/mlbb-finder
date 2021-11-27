<?php
require_once("../../config/db.php");

if (isset($_GET['createdBy'])) {
    $createdBy = filter_var($_GET['createdBy']);

    $sql = "
      SELECT * FROM `tbl_tickets`
      LEFT JOIN `tbl_users`
      ON tbl_tickets.createdBy = tbl_users.user_id
      WHERE createdBy=$createdBy
      ORDER BY tbl_tickets.updatedAt DESC
    ;";

    $result = $mysqli->query($sql);

    if (!$result) {
        echo "CreatedBy is invalid!";
        http_response_code(406);
        return;
    }

    echo json_encode(mysqli_fetch_all($result));
} else {
    echo "No createdBy found!";
    http_response_code(401);
}