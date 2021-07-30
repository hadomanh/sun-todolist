<?php
    require_once('../includes/initialize.php');
    $sql = "DELETE FROM `todo` WHERE id=".$_GET['id'];
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        require_once('listTodo.php');
    } else {
        echo "Error";
    }
?>