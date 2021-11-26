<?php
function authenticate($doRedirectOnFail=true) {
  $authResult = false;

  if (isset($_COOKIE["token"])) {
    
    $authResult = CallAPI("GET", "http://localhost/server/api/users/me.php", false, array(
      "Authorization: Bearer " . $_COOKIE["token"]
    ));
    
    if (!$authResult) {
      header('Location: http://localhost/web/index.php');
    } else {
      $me = json_decode($authResult);
      $_SESSION["user"] = $me;
    }
  } else {
    header('Location: http://localhost/web/index.php');
  }

  return $me;
}