<?php
require_once('includes/initialize.php');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="img/todo.png"
                alt="" width="30" height="30" class="d-inline-block align-text-top">
            Todo list
        </a>

        <div class="collapse navbar-collapse d-flex justify-content-end">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">
                            Greetings, <?= $_SESSION['fullname'] ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>