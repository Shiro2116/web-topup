<?php
require_once("config.php");
$cookie_name = $x_token;
setcookie($cookie_name, 1, time() + (86400 * (30*12)), "/");
header("Location: /user/login");