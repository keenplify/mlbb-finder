<?php
require("./helpers/cURL.php");

$me = false;
$result = false;

// Check if token is valid
if (isset($_COOKIE["token"])) {
  $token = $_COOKIE["token"];
  $result = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
    "Authorization: Bearer " . $token
  ));

  if ($result) {
    header('Location: /');
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Log In CSS-->
  <link rel="stylesheet" type="text/css" href="Login.css">

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
  <title>Mobile Legends: Bang Bang Player Finder Web Application</title>
</head>

<body>
  <!--- Registration Form --->
  <div class="form1 col-lg-12">
    <section class="Registration m-auto mt-5 col-lg-5">
      <div class="col-lg-12 p-3">

        <div class="form-row pl-1">
          <div class="offset-1 col-lg-9">
            <i class="fas fa-times" id="exit"></i>
          </div>
        </div>
        <h1>Create an Account</h1>
        <form>
          <div class="form">
            <div class="offset-1 col-lg-12 m-auto">
              <label for="validationTooltip01" class="form-label">First Name: </label>
              <input type="text" class="form-control" placeholder="First Name" required>
            </div>
          </div>

          <div class="form py-1">
            <div class="offset-1 col-lg-12">
              <label for="validationTooltip01" class="form-label">Last Name: </label>
              <input type="text" class="form-control" placeholder="Last Name" required>
            </div>
          </div>

          <div class="mb-1">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
            <div id="emailHelp" class="form-text">We'll never share your Username with anyone else.</div>
          </div>

          <label for="inputPassword5" class="form-label">Password</label>
          <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Password">
          <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>

          <div class="form-row py-4">
            <div class="offset-1 col-lg-20">
              <button class="btn1">Sign Up</button>
            </div>
          </div>

          <div class="form">
            <div class="col-lg-15">
              <p class="text-secondary">Already have an account?<a class="nav-link" id="Login">Log in</a></p>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>

  <!--- Log In Form --->
  <section class="login m-auto py-5 ">
    <div class="container">
      <div class="row g-0">
        <div class="col-md-5">
          <img src="img/photo-1580820267682-426da823b514.jfif" class="img-fluid">
        </div>
        <div class="col-lg-7 p-4 py-5 text-center">
          <h1>Welcome Back</h1>
          <div id="login-output" class="alert alert-danger" role="alert" style="visibility: hidden">
            <h4 class="alert-heading">There's something wrong!</h4>
            <p class="mb-0" id="output">
              </sp>
          </div>
          <form id="login-form">
            <div class="form-row py-4">
              <div class="offset-1 col-lg-10">
                <i class="fas fa-user"></i><input type="text" id="username" class="inp" name="username" placeholder="UserName" required>
              </div>
            </div>


            <div class="form-row py-3">
              <div class="offset-1 col-lg-10">
                <i class="fas fa-lock"></i><input type="password" id="password" class="inp" name="password" placeholder="Password" required>
              </div>
            </div>


            <div class="form-row py-3">
              <div class="offset-1 col-lg-20">
                <button class="btn1" type="submit">Log In</button>
              </div>
            </div>

            <div class="form-row py-2">
              <div class="col-lg-15">
                <p class="text-secondary">Don't have account?<a class="nav-link" id="Signup" href="#">Sign Up</a></p>
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
                    window.location.href = "/web/dashboard"
                  }
                }
              })
              return false;
            }
          </script>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.getElementById("Signup").addEventListener("click", function() {
      document.querySelector(".form1 ").style.display = "flex";
    })
    document.querySelector(".fa-times").addEventListener("click", function() {
      document.querySelector(".form1").style.display = "none";
    })
    document.getElementById("Login").addEventListener("click", function() {
      document.querySelector(".form1").style.display = "none";
    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>