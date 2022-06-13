<?php
require_once 'ConnectDB.php';
session_start();
$conn = mysqli_connect($MYSQL_HOST,$MYSQL_USERNAME,$MYSQL_PASSWORD);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysqli_select_db($conn,$MYSQL_DB);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$sql = "SELECT * FROM UserInformation WHERE username = '$username' AND password = '$password'";
$result = $conn -> query($sql);
if(isset($_POST['login'])){
    if(mysqli_num_rows($result) === 1){
        while ($row = $result -> fetch_assoc()) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['SDT'] = $row['SDT'];
            $_SESSION['is_login'] = true;
            $_SESSION['id'] = $row['ID'];
        header('Location: index.php');
        }
    }
    else{
        header("location:login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <link href="./assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form method="POST" name="login">
                                        <div class="form-group">
                                            <label><strong>username</strong></label>
                                            <input type="username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign me in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/vendor/global/global.min.js"></script>
    <script src="./assets/js/quixnav-init.js"></script>
    <script src="./assets/js/custom.min.js"></script>

</body>

</html>