<?php
session_start();
require("./helpers/cURL.php");
require("./helpers/url.php");

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
  <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
    <script>
      var USER = JSON.parse(`<?php print json_encode($me)?>`);
    </script>
    <title>MLBB Accounts - Mobile Legends: Bang Bang Player Finder</title>
    <link rel="shortcut icon" type="text/css" href="img/Logo.jpg">
  
    <!-- Log In CSS-->
    <link rel="stylesheet" type="text/css" href=".//css/mlbbdata.css">
   <!---------------------------- Bootstrap ---------------------------->
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

  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
          <nav class="vertical-nav navbar-expand-lg navbar-dark bd-dark flex-md-column flex-row  py-2  sticky-top" id="sidebar">
          <div class="container"> 
                <a href="dashboard.php" class="navbar-brand fs-2">GameBuddies</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navbar">
                <span class="navbar-toggler-icon justify-content-end"></span>
                 </button>
            </div>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav flex-column">

        <div class="time text-center p-3">
              <p class="fs-4 lh-base">
              <span>Timer:</span>
              <span id="timer">0</span>  
              <br>
              <span>Online Users:</span>
              <span id="onlineCount">0</span>
              </p>
        </div>

        <li class="nav-item m-auto w-100">
           <button onclick="toggle()" id="start_btn" class="b1 btn btn-danger w-100 fs-6">ENQUEUE</button>
        </li>
        <br>

        <?php include "./components/Search.php"; ?>
        <br>
        
        <li class="nav-item li-hover li-dark ">
        <a href="Profile/view.php?user_id=<?php echo $me -> user_id?>" class="btn text-white fs-6 mx-4">Profile</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="friends/requests.php" class="btn text-white fs-6 mx-4">Friend Requests</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="tickets" class="btn text-white fs-6 mx-4">Ticket</a>
        </li>
        <br>
        
        <li class="nav-item">
        <a href="mlbbdata.php" class="btn text-white fs-6 mx-4">MLBB Accounts</a>
        </li>
        <br>

        <li class="nav-item">
        <a href="<?php echo getOrigin_URL(); ?>/web/settings.php" class="btn text-white fs-6 mx-4">Settings</a>
        </li>
        <br>
      
        <li class="nav-item">
        <a href="http://localhost/server/api/users/logout.php" class="btn text-white fs-6 mx-4">Logout</a>
        </li>
      </ul>
</div>      
</nav>
      </aside>

    <main class="col px-0 flex-grow-1">
 
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
            <th scope="col"  style="background: #3b3b3b;">ML ID</th>
            <th scope="col"  style="background: #3b3b3b;">In Game Name</th>
            <th scope="col"  style="background: #3b3b3b;">Created At</th>
            <th scope="col"  style="background: #3b3b3b;">Actions</th>
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

</main>
      
    </div>
    
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>




   
  </body>
</html>