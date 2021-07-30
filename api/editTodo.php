<?php
    require_once('../includes/initialize.php');
    $sql = $_GET['deadline']  != ''
        ? "UPDATE `todo` SET `title` = '".$_GET['title']."', `description` = '".$_GET['description']."', `deadline` = '".$_GET['deadline']."', `status` = '".$_GET['status']."' WHERE `id` = ".$_GET['id']
        : "UPDATE `todo` SET `title` = '".$_GET['title']."', `description` = '".$_GET['description']."', `status` = '".$_GET['status']."' WHERE `id` = ".$_GET['id'];
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        require_once('listTodo.php');
    } else {
        echo "Error";
    }
?>