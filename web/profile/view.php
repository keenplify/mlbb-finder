<?php
  session_start();
  require_once("../helpers/cURL.php");
  require_once("../helpers/authenticate.php");
  require_once("../helpers/url.php");
  require_once("../helpers/getRandomImage.php");

  $me = authenticate(false);

  if (!isset($_GET['user_id'])) {
    echo "Invalid profile.";
    http_response_code(400);
    return;
  }
  $getUser = CallAPI("GET", "http://localhost/server/api/users/index.php?user_id=".$_GET['user_id'], false);
  $user = json_decode($getUser);
  if (is_null($user)) {
    echo "User not found.";
    http_response_code(404);
    return;
  }

  $getAllFriends = CallAPI("GET", "http://localhost/server/api/friends/getAll.php?user_id=".$_GET['user_id'], false);
  $allFriends = json_decode($getAllFriends);


  $getFriendship = CallAPI("GET", "http://localhost/server/api/friends/getFriendship.php?user1_id=".$_GET['user_id'].'&user2_id='.$me->user_id, false);
  $friendship = json_decode($getFriendship);
?>

<script>
  const TICKETS = JSON.parse(`<?php echo $getUser; ?>`);
</script>

<html>
  <head>
    <title>Profile - Gamebuddies</title>
    <?php require "../helpers/libraries.php" ?>

    <!---------------------------- CSS---------------------------->
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
  </head>
  <body>
    <div class="container">
      <?php include '../components/ProfileCard.php'; ?>
      <div class="row p-3">
        <div class="col-md-6">
          <?php include '../components/PlayerTickets.php'; ?>
        </div>
        <div class="col-md-6">
          <?php include '../components/Friends.php'; ?>
        </div>
      </div>
    </div>
  </body>
</html>