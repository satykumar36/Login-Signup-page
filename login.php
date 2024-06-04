<?php
$show_alert = false;
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "partials/db_connect.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "Select * from users where email='$email';";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {

                $show_alert = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                header("location: /php_saty/login_system/welcome.php");
            } else {
                $show_error = true;
            }
        }
    } else {
        $show_error = true;
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
        <strong>Hurray!</strong> You have successfully logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($show_error) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Sorry!</strong> Invalid Credentials.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    ?>

    <!-- SignUp Form -->
    <div class="container col-md-6 border border-dark p-3 mt-5">
        <h1 class="text-center text-primary">LogIn Page</h1>
        <form action="/php_saty/login_system/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Username or Email address</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>