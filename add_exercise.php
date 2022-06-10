<?php
include 'session.php';
require_once 'ConnectDB.php';
if (!(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true)) {
    header('Location: login.php');
    exit();
}
if (!(isset($_SESSION['role']) && $_SESSION['role'] == 'teacher')) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}
require_once 'ConnectDB.php';
$conn = mysqli_connect($MYSQL_HOST,$MYSQL_USERNAME,$MYSQL_PASSWORD);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysqli_select_db($conn,$MYSQL_DB);
//upload file
if (isset($_POST['AddExercise'])){
    $overview = $_POST['Overview'];
    $name = $_POST['Name'];
    $Description = $_POST['Description'];
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png','gif','pdf','docx','zip','rar');
    if (in_array($fileActualExt,$allowed)){
        if ($fileError === 0){
            if ($fileSize < 1000000){
                $fileDestination = 'upload/'.$fileName;
                move_uploaded_file($fileTmpName,$fileDestination);
                $sql = "INSERT INTO Chall (Challname,Challoverview,Challdescription,Challfolder,filename,Challtype) VALUES ('$name','$overview','$Description','$fileDestination','$fileName','$fileType')";
                $result = $conn -> query($sql);
                if ($result) {
                    echo "<script>alert('Add exercise success');</script>";
                    header ('Location: exercise.php');
                }
                else {
                    echo "<script>alert('Add exercise fail');</script>";
                }
            }
            else {
                echo "<script>alert('File size too large');</script>";
            }
        }
        else {
            echo "<script>alert('File upload failed');</script>";
        }
    }
    else {
        echo "<script>alert('File type not allowed');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AddExercise</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/KC (1).png">
    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="./assets/images/KC.png" alt="">
                <img class="logo-compact" src="./assets/images/logo-text.png" alt="">
                <img class="brand-title" src="./assets/images/logo-text.png" alt="">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profile.php" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="index.php" aria-expanded="false"><i class="icon icon-home"></i><span
                                class="nav-text">Home</span></a>
                    </li>
                    <li><a href="/exercise.php" aria-expanded="false"><i class="icon icon-single-copy-06"></i><span
                                class="nav-text">Exercises</span></a>
                    </li>
                    <li><a href="student.php" aria-expanded="false"><i class="icon icon-users-mm"></i><span
                                class="nav-text">Students</span></a>
                    </li>
                    <?php if (isset($_SESSION['role']) && ( $_SESSION['role'] == 'teacher')) { ?>
                    <li><a href="add_exercise.php" aria-expanded="false"><i class="icon icon-single-copy-06"></i><span
                                class="nav-text">Add exercise</span></a>
                    </li>
                    <li><a href="add_user.php" aria-expanded="false"><i class="icon icon-users-mm"></i><span
                                class="nav-text">Add user</span></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="content-body" id="app">
            <!-- row -->
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">AddExercise</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" name="AddExercise" enctype="multipart/form-data">
                                <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="Name"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Overview</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="Overview"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="Description"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="fallback">
                                        <input name="file" type="file" />
                                    </div>
                                    <center>
                                        <button type="submit" class="btn btn-primary" name="AddExercise">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!-- Required vendors -->
    <script src="./assets/vendor/global/global.min.js"></script>
    <script src="./assets/js/quixnav-init.js"></script>
    <script src="./assets/js/custom.min.js"></script>
    <!-- Owl Carousel -->
    <script src="./assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <!-- Counter Up -->
    <script src="./assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="./assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
</body>

</html>