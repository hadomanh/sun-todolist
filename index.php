<?php
    require_once('includes/initialize.php');
    redirect((isset($_SESSION['username']) && $_SESSION['username'] != Null) ? 'frontend/mainpage.html' : 'login.php');
?>