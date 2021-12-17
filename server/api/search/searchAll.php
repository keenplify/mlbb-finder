<?php
  require_once("../../config/db.php");

  if (!isset($_GET['keyword'])) {
    echo "Keyword not found";
    die();
  }

  $sql1 = 
  'SELECT * FROM tbl_users
   WHERE firstname LIKE "%'.$_GET["keyword"].'%" 
   OR lastname LIKE "%'.$_GET["keyword"].'%"
   OR CONCAT(firstname, " ", lastname) LIKE "%'.$_GET["keyword"].'%"
   OR username LIKE "%'.$_GET["keyword"].'%"
   OR email LIKE "%'.$_GET["keyword"].'%"
   LIMIT 10 
   ';  
  $sql2 =
  'SELECT * FROM tbl_tickets
  LEFT JOIN tbl_users
  ON tbl_tickets.createdBy = tbl_users.user_id
   WHERE title LIKE "%'.$_GET["keyword"].'%"
   OR BODY LIKE "%'.$_GET["keyword"].'%"
   ORDER BY tbl_tickets.updatedAt DESC
  ';
  $result1 = $mysqli->query($sql1);
  $result2 = $mysqli->query($sql2);
?>

{
  "users" : <?php echo json_encode($result1->fetch_all(MYSQLI_ASSOC)); ?>,
  "tickets": <?php echo json_encode($result2->fetch_all(MYSQLI_ASSOC)); ?>
}