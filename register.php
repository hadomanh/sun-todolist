<?php 
require_once('includes/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://static.appvn.com/a/uploads/thumbnails/042021/tasksd-todo-listd-task-listd-reminder_icon.png"
                    alt="" width="30" height="30" class="d-inline-block align-text-top">
                Todo list
            </a>

            <div class="collapse navbar-collapse d-flex justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="register.php">Register</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <?php check_message(); ?>

    <div class="container d-flex justify-content-center">
        <div class="mt-3 bg-light p-5">
            <div class="text-center">
                <img style="width: 50%;"
                    src="https://static.appvn.com/a/uploads/thumbnails/042021/tasksd-todo-listd-task-listd-reminder_icon.png"
                    alt="">

            </div>
            <h2 class="mb-3 text-center">Register</h2>
            <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control" id="fullname">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Confirm Password</label>
                    <input type="password" name="password2" class="form-control" id="password2">
                </div>
                <button type="submit" name="submitBtn" style="width: 100%;" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</body>

</html>

<?php
if (isset($_POST['submitBtn'])) {
    $sql = "INSERT INTO users (`email`, `fullname`, `password`) VALUES ('".$_POST['email']."', '".$_POST['fullname']."', '".sha1($_POST['password'])."')";
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        message("User registered sucessfully. Please log in.", 'success');
        redirect('login.php');
    } else {
        message($mydb->error_msg.'</br>'.$sql, 'info');
        redirect('register.php');
    }
}