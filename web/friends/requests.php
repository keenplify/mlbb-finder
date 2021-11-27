<?php
  session_start();
  require_once("../helpers/cURL.php");
  require_once("../helpers/authenticate.php");
  require_once("../helpers/url.php");
  require_once("../components/TicketCard.php");
  require_once("../components/EditTicket.php");

  $me = authenticate(false);
  $getAllFriendRequests = CallAPI("GET", "http://localhost/server/api/friends/getAllRequests.php?user_id=".$me->user_id, false);
  $requests = json_decode($getAllFriendRequests);
?>

<html>
  <head>
    <title>Friend Requests - Gamebuddies</title>
    <?php require "../helpers/libraries.php" ?>

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
  </head>
  <body>
    <div class="container">
      <h1>Friend Requests</h1>
      <?php
        foreach($requests as $request) {
          echo '
            <div class="card p-1">
            <div class="d-flex aligh-items-center">
              <span class="bg-primary rounded-circle avatar-sm">
              '.substr($request->firstname, 0, 1).'
              </span>
              <span class="ml-2">
                '.$request->firstname.' '. $request->lastname .'
              </span>
              <div class="ml-auto">
                <a class="btn btn-success" href="'. getOrigin_URL() .'/server/api/friends/accept.php?friend_id='. $request->friend_id .'&redirect='.getFull_URL().'">
                  <span class="oi oi-plus mx-1"></span>
                  Accept
                </a>
                <a class="btn btn-danger" href="'. getOrigin_URL() .'/server/api/friends/delete.php?friend_id='. $request->friend_id .'&redirect='.getFull_URL().'">
                  <span class="oi oi-minus mx-1"></span>
                  Cancel
                </a>
              </div>
            </div>
            </div>
          ';
        }
      ?>
    </div>
  </body>
</html>