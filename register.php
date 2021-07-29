<?php
require_once('index.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?php require_once('api/navbar.php') ?>

    <?php check_message() ?>

    <div class="container d-flex justify-content-center">
        <div class="mt-3 bg-light p-3">
            <div class="text-center">
                <img style="width: 50%;" src="img/todo.png" alt="">
            </div>
            <h2 class="mb-3 text-center">Register</h2>
            <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                    <small class="invalid-feedback">Wrong email format</small>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" name="password1" class="form-control" id="password1" required>
                    <small class="invalid-feedback">Password must contains at least 6 characters</small>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Confirm Password</label>
                    <input type="password" name="password2" class="form-control" id="password2" required>
                    <small class="invalid-feedback">Incorrect password</small>
                </div>
                <button disabled id="submitBtn" name="submitBtn" type="submit" style="width: 100%;" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</body>

<script>
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePassword(password) {
        return password.length >= 6
    }

    function validateAll(email, password1, password2) {
        return validateEmail(email) && validatePassword(password1) && password1 === password2
    }

    function checkSubmit(emailEl, passwordEl1, passwordEl2, submitBtn) {
        if (validateAll(emailEl.value, passwordEl1.value, passwordEl2.value)) {
            submitBtn.disabled = false
        } else {
            submitBtn.disabled = true
        }
    }

    const email = document.getElementById('email')
    const password1 = document.getElementById('password1')
    const password2 = document.getElementById('password2')
    const submitBtn = document.getElementById('submitBtn')

    email.addEventListener('input', event => {
        checkSubmit(email, password1, password2, submitBtn)
        if (!validateEmail(event.target.value)) {
            email.classList.add('is-invalid')
            email.classList.remove('is-valid')
        } else {
            email.classList.remove('is-invalid')
            email.classList.add('is-valid')
        }
    })


    password1.addEventListener('input', event => {
        checkSubmit(email, password1, password2, submitBtn)
        if (!validatePassword(event.target.value)) {
            password1.classList.add('is-invalid')
            password1.classList.remove('is-valid')
        } else {
            password1.classList.remove('is-invalid')
            password1.classList.add('is-valid')
        }
    })

    password2.addEventListener('input', event => {
        checkSubmit(email, password1, password2, submitBtn)
        if (event.target.value !== password1.value) {
            password2.classList.add('is-invalid')
            password2.classList.remove('is-valid')
        } else {
            password2.classList.remove('is-invalid')
            password2.classList.add('is-valid')
        }
    })
</script>

</html>

<?php
if (isset($_POST['submitBtn'])) {
    $sql = "INSERT INTO users (`email`, `fullname`, `password`) VALUES ('" . $_POST['email'] . "', '" . $_POST['fullname'] . "', '" . password_hash($_POST['password1'], PASSWORD_DEFAULT) . "')";
    $mydb->setQuery($sql);
    if ($mydb->executeQuery()) {
        message("User registered sucessfully. Please log in.", 'success');
        redirect('login.php');
    } else {
        message($mydb->error_msg . '</br>' . $sql, 'info');
        redirect('register.php');
    }
}
?>
