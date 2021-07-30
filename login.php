<?php
require_once('includes/initialize.php');
if (isset($_SESSION['email']) && $_SESSION['email'] != Null) redirect('home.php');
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
    <?php require_once('api/navbar.php') ?>

    <?php check_message() ?>

    <?php echo $_SERVER['REQUEST_URI'] ?>

    <div class="container d-flex justify-content-center">
        <div class="mt-3 bg-light p-3">
            <div class="text-center">
                <img style="width: 50%;" src="img/todo.png" alt="">
            </div>
            <h2 class="mb-3 text-center">Welcome</h2>
            <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe"> Remember me</label>
                </div>
                <button type="submit" name="submitBtn" style="width: 100%;" class="btn btn-primary">Login</button>
            </form>
        </div>

    </div>
</body>

</html>

<?php
if (isset($_POST['submitBtn'])) {
    $sql = "SELECT * FROM `users` WHERE `email` = '" . $_POST['email'] . "'";
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        $row = $mydb->loadSingleResult();
        if ($row)
            if (password_verify($_POST['password'], $row->password)) {
                message("Logged in sucessfully.", 'success');
                $_SESSION['email']          = $row->email;
                $_SESSION['fullname']          = $row->fullname;
                if ($_POST['rememberMe'])
                    setcookie("email", $_SESSION['email'], time()+3600*24*30, "/","", 0);
                redirect('home.php');
            } else {
                message("Wrong password.", 'error');
                redirect('login.php');
            }
        else {
            message("Wrong email.", 'error');
            redirect('login.php');
        }
    } else {
        message("Database error.", 'error');
        redirect('login.php');
    }
}
