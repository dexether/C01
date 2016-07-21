<?php
$email = "john.doe@example.com";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  $output = true;
} else {
  $output = false;
}
echo $output;
?> 