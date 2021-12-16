<?php

function UserCard($user, $userId) {
  echo 
  '<div class="card my-2 bg-dark">
    <a class="card p-2 bg-dark p-3 text-decoration-none" href="'.getOrigin_URL().'/web/profile/view.php?user_id='. $userId .'">
      <div class="d-flex align-items-center">
        <span class="bg-primary rounded-circle avatar-sm">
        '.substr($user->firstname, 0, 1).'
        </span>
        <span class="mx-2 link-light">
          '.$user->firstname.' '. $user->lastname .'
        </span>
      </div>
    </a>
  </div>';
}