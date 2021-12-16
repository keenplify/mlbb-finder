<?php
  require_once("../helpers/cURL.php");
  require_once("../components/UserCard.php");
?>

<div class="container">
  <h4 class="display-6"><?php echo $user->firstname. ' '.$user->lastname?>'s FRIENDS</h4>
  <?php
    foreach($allFriends as $friend) {
      
      $userId = $friend->createdBy;
      if ($userId == $user->user_id) $userId = $friend->friendUserId;

      $getUser = CallAPI("GET", "http://localhost/server/api/users/index.php?user_id=".$userId, false);
      $user = json_decode($getUser);

      echo UserCard($user, $userId);
    }
  ?>
</div>