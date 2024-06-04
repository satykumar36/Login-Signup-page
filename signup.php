<?php
$show_alert = false;
$show_error = false;
$show_error_exist = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "partials/db_connect.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exists = false;
    $exist_sql = "SELECT * FROM users WHERE email='$email'";
    $exist_result = mysqli_query($conn, $exist_sql);
    $exist_num = mysqli_num_rows($exist_result);

    if ($exist_num > 0) {
        $show_error_exist = true;
    } else {


        if (($password == $cpassword) && $exists == false) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hash');";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $show_alert = true;
            }
        } else {
            $show_error = true;
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    require "partials/_nav.php";
    ?>
    <?php
    if ($show_alert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hurray!</strong> Your account have been successfully created please login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($show_error) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Your password does not match.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($show_error_exist) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Username already exists.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    ?>

    <!-- SignUp Form -->
    <div class="container col-md-6 border border-dark p-3 mt-5">
        <h1 class="text-center text-primary">SignUp Page</h1>
        <form action="/php_saty/login_system/signup.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Username or Email address</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to enter same password.</div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>