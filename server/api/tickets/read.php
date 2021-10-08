<?php
require_once("../../config/db.php");

if (
    isset($_POST['username']) &&
    isset($_POST['title']) &&
    isset($_POST['body']) 
  ) {
    $createdBy = filter_var($_POST['username']);
    $title = filter_var($_POST['title']);
    $body = filter_var($_POST['body']);

    $sql = "SELECT * FROM tbl_tickets WHERE createdBy ='$createdBy' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Updated At</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["createdBy"]."</td> 
                <td>".$row["title"]."</td> 
                <td>".$row["body"]."</td> 
                <td>".$row["createdAt"]."</td> 
                <td>".$row["updatedAt"]."</td>
              </tr>";
     }
        echo "</table>";
    } else {
  echo "0 results";
    }
    $conn->close();
} else {
  //If all statements are wrong, Return error 400
  http_response_code(400);
}