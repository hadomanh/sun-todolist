<?php
    require_once('../includes/initialize.php');
    $sql = $_GET['deadline']  != ''
        ? "INSERT INTO `todo` (title, description, deadline, user) VALUES ('".$_GET['title']."', '".$_GET['description']."', '".$_GET['deadline']."', '".$_SESSION['email']."')"
        : "INSERT INTO `todo` (title, description, user) VALUES ('".$_GET['title']."', '".$_GET['description']."', '".$_SESSION['email']."')";
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        require_once('listTodo.php');
    } else {
        echo "Error";
    }
?>