<?php

require("./helpers/cURL.php");

$result = CallAPI("GET", "http://localhost/server/api/users/me.php");
print($result);
