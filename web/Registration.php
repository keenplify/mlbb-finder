<!doctype html>
<html lang="en">
  <head>
     <link rel="shortcut icon" type="text/css" href="img/Logo.jpg"> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Log In CSS-->
    <link rel="stylesheet" type="text/css" href="Registration.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&family=Prompt:wght@500&display=swap" rel="stylesheet">  

    <!-- Animation Css-->
     <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

     <!-- FontAwesome Icon-->
    <script src="https://kit.fontawesome.com/d75cefc660.js" crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="./js/jquery-3.6.0.min.js"></script>
    <title>Register | Mobile Legends: Bang Bang Player Finder Web Application</title>
  </head>

        <body>
          <!--- Registration Form --->
          <div class="container">
            <div class="row">
            <div class="col-md-6 offset-md-3">
            <div class="signup-form" id="signup-form">

              <form class="mt-5 border p-4 bg-light shadow">
                <h1 class="text-center py-2">Create a Account</h1>
                <div id="signup-output" class="alert alert-danger d-none" role="alert">
                    <h4 class="alert-heading">There's something wrong!</h4>
                    <p class="mb-0" id="output">
                      </sp>
                  </div>
                <div class="row">
                <div class="mb-3 col-md-6">
                  
                <label>First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter a Firstname" required>
              </div>

              <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter a Lastname" required>
              </div>

              <div class=" col-md-12">
                <label>Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter a Username" required>
                <div id="passwordHelpBlock" class="form-text">We'll never share your email with anyone else.
               </div>
              </div>

              <div class=" col-md-12">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter a Password" required>
                <div id="passwordHelpBlock" class="form-text"> Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
              </div>

              <div class="row  py-2">
                <div class=" col-md-6">
                <label>Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" required>
              </div>

              <div class=" col-md-6">
                <label>Birthday</label>
                <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Birthday" required>
              </div>
              </div>

            <div class="row py-2">
              <div class="col-md-5 d-flex justify-content-center align-items-center"> 
               <button type="submit" class="btn btn-success w-100">Sign Up</button>
              </div>

              <div class="col-md-7 d-flex justify-content-center align-items-center"> 
                <p class="text-secondary m-0">Have a Account Already? <br> <a id="Signup" href="Login.php">Log In</a> </p>
              </div>  
            </div>  
            
            </div>
              </form>
              <script defer>
                const date = new Date()
                date.setFullYear(date.getFullYear() - 18); 
                document.querySelector("#birthday").value = formatDate(date) 
                
                function getAge(birthDateString) {
                  var today = new Date();
                  var birthDate = new Date(birthDateString);
                  var age = today.getFullYear() - birthDate.getFullYear();
                  var m = today.getMonth() - birthDate.getMonth();
                  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                      age--;
                  }
                  return age;
                }

                function formatDate(date) {
                  var d = new Date(date),
                      month = '' + (d.getMonth() + 1),
                      day = '' + d.getDate(),
                      year = d.getFullYear();

                  if (month.length < 2) 
                      month = '0' + month;
                  if (day.length < 2) 
                      day = '0' + day;

                  return [year, month, day].join('-');
                }

                const form = document.querySelector("#signup-form")
                const output = document.querySelector("#signup-output")
                form.onsubmit = function(event) {
                  event.preventDefault();
                  const data = {
                    firstname: form.querySelector("#firstname").value,
                    lastname: form.querySelector("#lastname").value,
                    username: form.querySelector("#username").value,
                    password: form.querySelector("#password").value,
                    birthday: form.querySelector("#birthday").value,
                    email: form.querySelector("#email").value
                  }

                  if (getAge(data.birthday) < 13) {
                    output.querySelector("#output").innerHTML = "Only 13 and above is allowed in this website!"
                    output.classList.remove("d-none")
                    return
                  }

                  $.ajax({
                    type: "POST",
                    url: "../server/api/users/add.php",
                    data,
                    success: (_data) => {
                      if (_data !== "User added successfully") {
                        output.querySelector("#output").innerHTML = _data
                        output.classList.remove("d-none")
                      } else {
                        window.location.href = "/web/Login.php"
                      }
                    },
                    error:(error => {
                      output.querySelector("#output").innerHTML = error.responseText
                      output.classList.remove("d-none")
                    })
                  })
                return false;
              }
            </script>
            </div>
            </div>
            </div>
          </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  
  </body>
</html>