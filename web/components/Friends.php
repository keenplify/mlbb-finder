<?php
  require_once("../helpers/cURL.php");
?>

<div class="container">
  <h4 class="display-6"><?php echo $user->firstname. ' '.$user->lastname?>'s FRIENDS</h4>
  <?php
    foreach($allFriends as $friend) {
      
      $userId = $friend->createdBy;
      if ($userId == $user->user_id) $userId = $friend->friendUserId;

      $getUser = CallAPI("GET", "http://localhost/server/api/users/index.php?user_id=".$userId, false);
      $user = json_decode($getUser);

      echo '
      <div class="card my-2 bg-dark">
          <a class="card p-2 bg-dark p-3 text-decoration-none" href="'.getOrigin_URL().'/web/profile/view.php?user_id='. $userId .'">
            <div class="d-flex">
              <span class="bg-primary rounded-circle avatar-sm">
              '.substr($user->firstname, 0, 1).'
              </span>
              <span class="ml-2">
                '.$user->firstname.' '. $user->lastname .'
              </span>
              <div class="d-flex flex-column justify-content-end ms-2">
              <button class="btn btn-sm btn-success">
                  <span class="oi oi-check mx-1"></span>
                  Friends
                </button>
                </div>
            </div>
          </a>
          </div>
      ';
    }
  ?>
</div>