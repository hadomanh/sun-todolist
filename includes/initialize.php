<?php
defined('server') ? null : define("server", "localhost");
defined('user') ? null : define("user", "admin");
defined('pass') ? null : define("pass", "admin");
defined('database_name') ? null : define("database_name", "suntodo");
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT')
    ? null
    : define('SITE_ROOT', strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN'
        ? $_SERVER['DOCUMENT_ROOT'] . DS . 'sun-todolist'
        : $_SERVER['DOCUMENT_ROOT']);

$this_file = str_replace('\\', '/', __File__);
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$web_root =  str_replace(array($doc_root, "include/config.php"), '', $this_file);
$server_root = str_replace('config/config.php', '', $this_file);

define('web_root', $web_root);
define('server_root', $server_root);

function checkCookiesForLogin() {
    if (isset($_COOKIE['loginInfo'])) {
        $temp = explode('<;>', $_COOKIE['loginInfo']);
        $_SESSION['email'] = $temp[0];
        $_SESSION['fullname'] = $temp[1];
    }
}

function redirect($location = Null) {
    if ($location != Null) 
        echo "<script> window.location='{$location}' </script>";
    else
        echo 'error location';
}

function message($msg = "", $msgtype = "info") {
        $_SESSION['message'] = $msg;
        $_SESSION['msgtype'] = $msgtype;
}

function check_message() {

    if (isset($_SESSION['message'])) {
        if (isset($_SESSION['msgtype'])) {
            if ($_SESSION['msgtype'] == "info") {
                echo  '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
            } elseif ($_SESSION['msgtype'] == "error") {
                echo  '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
            } elseif ($_SESSION['msgtype'] == "success") {
                echo  '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            }
            unset($_SESSION['message']);
            unset($_SESSION['msgtype']);
        }
    }
}

require_once('database.php');
session_start();
checkCookiesForLogin();
