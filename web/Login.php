<?php
require("./helpers/cURL.php");

$result = false;

// Check if token is valid
if (isset($_COOKIE["token"])) {
  $result = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
    "Authorization: Bearer " . $_COOKIE["token"]
  ));
  

  if ($result) {
    header('Location: http://localhost/web/dashboard.php');
  }
}

?>

<!doctype html>
<html lang="en">

<head>
<link rel="shortcut icon" type="text/css" href="img/Logo.jpg"> 
<!---------------------------- CSS---------------------------->

  <!-- Required meta tags -->
  <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
  <meta http-equiv="pragma" content="no-cache" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Log In CSS-->
  <link rel="stylesheet" type="text/css" href="css/Login.css">

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
  <title>Login | Mobile Legends: Bang Bang Player Finder Web Application</title>
</head>

<body class="bg-dark">
  <!--- Log In Form --->
  <div class="container">
    <section class="login m-auto py-5">
      <div class="row g-0">
        <div class="col-md-5">
          <img src="img/mobile-legends-bruno.jpg" class="img-fluid">
        </div>
        <div class="col-lg-7 py-4 text-center">
          <h1>Welcome Back</h1>
          <div id="login-output" class="alert alert-danger" role="alert" style="visibility: hidden">
            <h4 class="alert-heading">There's something wrong!</h4>
            <p class="mb-0" id="output">
              </sp>
          </div>
          <form id="login-form">
            <div  class="d-flex justify-content-center flex-column w-100">
              <div class="form-row">
                <div>
                  <i class="fas fa-user"></i><input type="text" id="username" class="inp" name="username" placeholder="UserName" required>
                </div>
              </div>

              <div class="form-row py-3">
                <div>
                  <i class="fas fa-lock"></i><input type="password" id="password" class="inp" name="password" placeholder="Password" required>
                </div>
              </div>
            </div>
            


            <div class="form-row py-1">
              <div class="offset-1 col-lg-15">
                <button class="btn1" type="submit">Log In</button>
              </div>
            </div>

            <div class="form-row py-2">
              <div class="col-lg-12">
                <p class="text-secondary">Don't have account?<a class="nav-link" id="Signup" href="Registration.php">Sign Up</a></p>
              </div>
            </div>

          </form>
          <script defer>
            const form = document.querySelector("#login-form")
            const output = document.querySelector("#login-output")
            form.onsubmit = function(event) {
              event.preventDefault();
              const username = form.querySelector("#username").value
              const password = form.querySelector("#password").value

              $.ajax({
                type: "POST",
                url: "../server/api/users/login.php",
                data: {
                  username,
                  password
                },
                success: (data) => {
                  if (data !== "Successful") {
                    output.querySelector("#output").innerHTML = data
                    output.style.visibility = "visible"
                  } else {
                    window.location.href = "/web/dashboard.php"
                  }
                }
              })
              return false;
            }
          </script>
        </div>
      </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>