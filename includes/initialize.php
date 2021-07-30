<?php
defined('server') ? null : define("server", "35.240.221.137");
defined('user') ? null : define("user", "test");
defined('pass') ? null : define("pass", "123456");
defined('database_name') ? null : define("database_name", "test");
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

$statuses = [0 => 'Todo', 1 => 'In progress', 2 => 'Done'];
$statusclass = [0 => 'text-danger', 1 => 'text-info', 2 => 'text-success'];

require_once('database.php');
session_start();
checkCookiesForLogin();

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

function setMessage($msg = "", $msgtype = "info") {
        $_SESSION['message'] = $msg;
        $_SESSION['msgtype'] = $msgtype;
}

function showNotification() {

    if (isset($_SESSION['message']) && isset($_SESSION['msgtype'])) {
        echo  '<div class="alert alert-'. $_SESSION['msgtype'] .'">' . $_SESSION['message'] . '</div>';

        unset($_SESSION['message']);
        unset($_SESSION['msgtype']);
        
    }
}

function sqltodate($mysqldate) {
    return date('d/m/Y', strtotime($mysqldate));
}

function getTodoes() {
    global $mydb;
    $sql = "SELECT * FROM `todo` WHERE `user` = '".$_SESSION['email']."'";
    $mydb->setQuery($sql);
    return $mydb->loadResultList();
}
