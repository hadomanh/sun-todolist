<?php
    require_once('includes/initialize.php');
    if (isset($_COOKIE['email'])) {
        $sql = "SELECT * FROM `users` WHERE `email` = '" . $_COOKIE['email'] . "'";
        $mydb->setQuery($sql);
        if ($mydb->executeQuery()) {
            $row = $mydb->loadSingleResult();
            if ($row) {
                $_SESSION['email'] = $row->email;
                $_SESSION['fullname'] = $row->fullname;
            }
        }
    }
    redirect((isset($_SESSION['email']) && $_SESSION['email'] != Null) ? 'home.php' : 'login.php');
?>