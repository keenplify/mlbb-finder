<?php
  require_once("../helpers/cURL.php");
?>

<div class="container">
  <h4><?php echo $user->firstname. ' '.$user->lastname?>'s Friends</h4>
  <?php
    foreach($allFriends as $friend) {
      
      $userId = $friend->createdBy;
      if ($userId == $user->user_id) $userId = $friend->friendUserId;

      $getUser = CallAPI("GET", "http://localhost/server/api/users/index.php?user_id=".$userId, false);
      $user = json_decode($getUser);

      echo '
          <a class="card p-2" href="'.getOrigin_URL().'/web/profile/view.php?user_id='. $userId .'">
            <div class="d-flex aligh-items-center">
              <span class="bg-primary rounded-circle avatar-sm">
              '.substr($user->firstname, 0, 1).'
              </span>
              <span class="ml-2">
                '.$user->firstname.' '. $user->lastname .'
              </span>
            </div>
          </a>
      ';
    }
  ?>
</div>