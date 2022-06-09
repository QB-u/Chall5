<?php
include 'session.php';
include 'ConnectDB.php';
if (!(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true)) {
    header('Location: login.php');
    exit();
}
$is_student = $_SESSION['role'] === 'student' ? true : false;
$ID = $_SESSION['id'];
if (isset($_POST['information'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $sdt = $_POST['SDT'];
    $sql = "UPDATE UserInformation SET username = '$username', fullname = '$fullname', Email = '$email', SDT = '$sdt' WHERE  ID = '$ID'";
    $result = $conn -> query($sql);
    if ($result) {
        echo "<script>alert('Update success!');</script>";
    }
    else {
        echo "<script>alert('Update fail!');</script>";
    }
}
$sql = "SELECT sender_id, receiver_id, content, time, username FROM UserInformation, mess WHERE sender_id = UserInformation.ID";
$result = $conn -> query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profile</title>
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
                                    <a href="/profile.php" class="dropdown-item">
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
                                <h4 class="card-title">Infomation</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" name="information">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="username"
                                                placeholder="<?php echo htmlentities($_SESSION['username']); ?>"
                                                <?php echo $is_student ? 'disabled' : ''; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Fullname</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="fullname"
                                                placeholder="<?php echo htmlentities($_SESSION['fullname']); ?>"
                                                <?php echo $is_student ? 'disabled' : ''; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="email"
                                                placeholder="<?php echo htmlentities($_SESSION['email']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="SDT"
                                                placeholder="<?php echo htmlentities($_SESSION['SDT']); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" name="information"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-secondary btn-block"
                                                data-toggle="modal"><a href = "changePassword.php">Change
                                                password</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>Content</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result -> fetch_assoc()) { ?>
                                <?php if ($row['sender_id'] !== $_SESSION['id']) { ?>
                            <tr>
                                <td><?php echo htmlentities($row['ID']); ?></td>
                                <td><?php echo htmlentities($row['username']); ?></td>
                                <td><?php echo htmlentities($row['content']); ?></td>
                                <td><?php echo htmlentities($row['time']); ?></td>
                            </tr>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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