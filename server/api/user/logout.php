<?php

setcookie('token', null, -1, '/');
unset($_COOKIE['token']);

header("Location: /");
