<?php
session_start();
// Jika bisa login maka ke index.php
if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

require 'function.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);


    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password='$password'");

    $row = mysqli_num_rows($result);

    // jika $row lebih dari 0, maka berhasil login dan masuk ke index.php
    if ($row > 0) {
        $_SESSION['login'] = true;

        header('location:index.php');
        exit;
    }
    // jika $row adalah 0 maka tampilkan error
    $error = true;  
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MainMaster</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary align-items-center" style="margin-top: 80px;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <img src="img/stechoq-logo.png" alt="" style="width:260px ;" class="img-fluid">
        </div>
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if (isset($error)) : ?>
                                        <div class="text-center">
                                            <p style="color: red; font-style: italic">username / password salah</p>
                                        </div>
                                    <?php endif; ?>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>