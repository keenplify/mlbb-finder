<?php
session_start();
require("./helpers/cURL.php");


$result = false;
$me = false;
if (isset($_COOKIE["token"])) {
  $result = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
    "Authorization: Bearer " . $_COOKIE["token"]
  ));
  

  if (!$result) {
    header('Location: http://localhost/web/dashboard.php');
  } else {
    $me = json_decode($result);
  }
}


?>
<html lang="en">
  <head>
    <script>
      var USER = JSON.parse(`<?php print json_encode($me)?>`);
    </script>
    <title>MLBB Accounts | Gamebuddy</title>
    <link rel="shortcut icon" type="text/css" href="img/Logo.jpg">
    <!-- Log In CSS-->
    <link rel="stylesheet" type="text/css" href="css/mlbbdata.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">

    <!-- Animation Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- FontAwesome Icon-->
    <script src="https://kit.fontawesome.com/d75cefc660.js" crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="./js/jquery-3.6.0.min.js"></script>

    <!-- OPEN ICONIC -->
    <link href="./img/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  </head>
  <body class="bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-grow-1 p-3">
        <div class="d-flex">
          <h1><i class="far fa-user-circle"></i> MLBB Accounts</h1>
        </div>
        <div class="d-flex ml-auto" style="margin-left: auto">
          <?php require("./components/addMLBBDataModal.php");?>
        </div>
      </div>
      <table class="table text-white text-center">
        <thead>
          <tr>
            <th class="fs-5" style="background: #3b3b3b;">Mobile Legends ID</th>
            <th class="fs-5" style="background: #3b3b3b;">In Game Name</th>
            <th class="fs-5" style="background: #3b3b3b;">Created At</th>
            <th class="fs-5" style="background: #3b3b3b;">Actions</th>
          </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
      </table>
    </div>

    <!-- Important Scripts! Dont Remove! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script defer>
      let ACTIVEDATA_ID = false

       function editMLBBData(data_id, ign, mlid) {
        ACTIVEDATA_ID = data_id
        $("#addMLBBDataLabel").html("Edit MLBB Account");
        $("#addMLBBData_ign").val(ign);
        $("#addMLBBData_mlid").val(mlid);
        $("#addMLBBDataModal").modal("show");
      }

      function deleteMLBBData(data_id) {
        if (window.confirm("Are you sure to delete this account data?")) {
          $.ajax({
            type: "POST",
            url: `http://localhost/server/api/mlbbdata/delete.php`,
            data: {
              data_id
            },
            success: (() => listUserMLBBDatas())
          })
        }
      }

      function listUserMLBBDatas() {
        $.ajax({
          type: "GET",
          url: `http://localhost/server/api/mlbbdata/getUserMLBBData.php?createdBy=${USER.user_id}`,
          success: (json) => {
            const data = JSON.parse(json)

            document.querySelector("#table-body").innerHTML = data.map((v)=>`
            <tr>
              <th>${v.mlid}</th>
              <td>${v.ign}</td>
              <td>${v.createdAt}</td>
              <td>
                <button type='button' class='btn btn-primary' onclick="editMLBBData('${v.data_id}', '${v.ign}', '${v.mlid}')">
                  <span class='oi oi-pencil'></span>
                  Edit
                </button>
                <button type='button' class='btn btn-danger' onclick="deleteMLBBData('${v.data_id}')">
                  <span class='oi oi-x'></span>
                  Delete
                </button>
              </td>
            </tr>
            `).join("");
          }
        })
      }

      listUserMLBBDatas()
    </script>
  </body>
</html>