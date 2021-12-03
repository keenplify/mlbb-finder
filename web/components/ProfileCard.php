<div class="card bg-dark">
  <div class="profile-cover-container">
    <img class="card-img-top profile-cover" src="<?php echo getRandomImage()?>" alt="Card image cap">
  </div>
  <div class="card-body">
    <div class="d-flex align-items-center">
      <div class="bg-primary rounded-circle avatar">
        <?php echo substr($user->firstname, 0, 1); ;?>
      </div>
      <div class="ml-3">
        <div>
          <span class="font-weight-bold fs-3 "><?php echo $user->firstname;?> <?php echo $user->lastname;?></span>
          <span class="badge badge-info"> @<?php echo $user->username; ?></span>
        </div>
        <div>
          <label for="friendsCount">Friends:</label>
          <span id="friendsCount"><?php echo count($allFriends)?></span>
        </div>
      </div>
      <div class="ml-auto">
        <form method="POST" action="<?php echo getOrigin_URL() ?><?php
          if ($friendship) echo "/server/api/friends/delete.php";
          else echo "/server/api/friends/index.php";
        ?>">
          <?php if ($friendship) echo '
            <input type="hidden" name="friend_id" value="'.$friendship->friend_id.'">
          ';?>
          <input type="hidden" name="friendUserId" value="<?php echo $_GET['user_id']; ?>">
          <input type="hidden" name="createdBy" value="<?php echo $me->user_id; ?>">
          <input type="hidden" name="redirect" value="<?php echo getFull_URL(); ?>">
          <?php
            if ($_GET['user_id'] == $me->user_id) echo "";
            else if (!$friendship) echo '
            <button class="btn btn-primary" type="submit">
              <span class="oi oi-plus mx-1"></span>
              Add Friend
            </button>';
            else {
              if ($friendship->isAccepted == 0) echo '
              <div class="d-flex flex-column align-items-center">
                <button class="btn btn-secondary">
                  <span class="oi oi-ellipses mx-1"></span>
                  Friend Request Sent
                </button>
                <small class="text-muted text-center">Clicking the button will <br> cancel the friend request.</small>
              </div>
              ';
              else echo '
              <div class="d-flex flex-column align-items-center">
                <button class="btn btn-success">
                  <span class="oi oi-check mx-1"></span>
                  Friends
                </button>
                <small class="text-muted text-center">Clicking the button <br>will unfriend the user.</small>
              </div>';
            }
          ?>
        </form>
      </div>
    </div>
  </div>
</div>