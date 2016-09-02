<?php
$skip_authentication = 1;
include("includes/functions.php");

session_unset();
$DB->close();
header("Location: login.php");

?>
