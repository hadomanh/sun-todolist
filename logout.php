<?php
require_once('includes/initialize.php');

unset($_SESSION['fullname'], $_SESSION['password'], $_SESSION['email']);
setcookie( "email", "", time()- 60, "/","", 0);
setcookie( "PHPSESSID", "", time()- 60, "/","", 0);
setMessage('Logged out successfully.', 'success');
redirect('index.php');
?>