<?php
session_start();
session_destroy();
setcookie("user_uuid", "", time() - 3600, "/");
header("Location: login.php");
exit;
