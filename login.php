<?php
require_once('includes/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://static.appvn.com/a/uploads/thumbnails/042021/tasksd-todo-listd-task-listd-reminder_icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                Todo list
            </a>

            <div class="collapse navbar-collapse d-flex justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <?php check_message() ?>

    <div class="container d-flex justify-content-center">
        <div class="mt-3 bg-light p-5">
            <img src="https://static.appvn.com/a/uploads/thumbnails/042021/tasksd-todo-listd-task-listd-reminder_icon.png" alt="">
            <h2 class="mb-3 text-center">Welcome</h2>
            <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" name="submitBtn" style="width: 100%;" class="btn btn-primary">Login</button>
            </form>
        </div>

    </div>
</body>

</html>

<?php
if (isset($_POST['submitBtn'])) {
    $h_pass = sha1($_POST['password']);
    $sql = "SELECT * FROM `users` WHERE `email` = '". $email ."' and `password` = '". $h_pass ."'";
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        message("Logged in sucessfully. Please log in.", 'success');
        $result = $mydb->loadSingleResult();
        $_SESSION['email']      	= $result->email;
        $_SESSION['fullname']      	= $$result->fullname;
        redirect('home.php');
    } else {
        message($mydb->error_msg.'</br>'.$sql, 'info');
        redirect('login.php');
    }
}