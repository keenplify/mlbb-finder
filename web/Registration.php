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

    <title>Mobile Legends: Bang Bang Player Finder Web Application</title>
  </head>

        <body>
          <!--- Registration Form --->
          <div class="container">
            <div class="row">
            <div class="col-md-6 offset-md-3">
            <div class="signup-form">

              <form action="" class="mt-5 border p-4 bg-light shadow">
                <h1 class="text-center py-2">Create a Account</h1>
                <div class="row">
                <div class="mb-3 col-md-6">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter a Firstname" required>
              </div>

              <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter a Lastname" required>
              </div>

              <div class=" col-md-12">
                <label>Username</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter a Username" required>
                <div id="passwordHelpBlock" class="form-text">We'll never share your email with anyone else.
               </div>
              </div>

              <div class=" col-md-12">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter a Password" required>
                <div id="passwordHelpBlock" class="form-text"> Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div>
              </div>

              <div class=" col-md-6">
                <label>Email address</label>
                <input type="text" name="email" class="form-control" placeholder="name@example.com" required>
              </div>

              <div class=" col-md-6 py-2">
                <label>Birthday</label>
                <input type="text" name="birth" class="form-control" placeholder="Birthday" required>
              </div>

            <div class="col-md-3"> 
               <button type="submit" class="btn btn-danger">Sign Up</button>
             </div>

            <div class="col-md-5"> 
            <p class="text-secondary">Have a Account Already?  <a class="nav-link" id="Signup" href="Login.php">Log In</p>
            </div>    
            
            </div>
              </form>
            </div>
            </div>
            </div>
          </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  
  </body>
</html>