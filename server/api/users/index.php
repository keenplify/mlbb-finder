<?php
/* GET api/user/ */
if (isset($_POST['id'])) {
  print_r($_POST);
  /* Code here */
}


/* PUT api/user/ */
if (isset($_POST['id'])) {
  print_r($_POST);
  /* Code here */
}

//If all statements are wrong, Return error 400
http_response_code(400);
