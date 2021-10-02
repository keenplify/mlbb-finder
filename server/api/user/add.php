<?php
  /* POST api/user/add */
  if (isset($_POST['firstname']) && isset($_POST['lastname']) && $_POST['username'] && $_POST['password'] && $_POST['birthday']) {
    print_r($_POST);
  }
?>