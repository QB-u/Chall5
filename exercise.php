<?php
include 'session.php';
if (!(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true)) {
    header('Location: login.php');
    exit();
}
$is_student = $_SESSION['role'] === 'student' ? true : false;
include 'ConnectDB.php';
$sql = 'SELECT  * FROM Chall';
$result = $conn -> query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=oleedge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Exercises</title>
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
                <img class="logo-abbr" src="assets/images/KC (1).png" alt="">
                <img class="logo-compact" src="assets/images/logo-text.png" alt="">
                <img class="brand-title" src="assets/images/logo-text.png" alt="">
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
                    <li><a href="exercise.php" aria-expanded="false"><i class="icon icon-single-copy-06"></i><span
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
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" id="app">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi <?php echo htmlentities($_SESSION['fullname']); ?>, welcome back!</h4>
                            <span class="ml-1"></span>
                        </div>
                    </div>
                </div>

                <!--**********************************
            Content body end
        ***********************************-->
        <table class="table table-bordered table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Chall Name</th>
                                                    <th>Overview</th>
                                                    <th>Description</th>
                                                    <th>FileUpload</th>
                                                    <th>Submit</th>
                                                    <?php if (isset($_SESSION['role']) && ( $_SESSION['role'] == 'teacher')) { ?>
                                                    <th>Delete</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result -> fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($row['idChall']); ?></td>
                                                        <td><?php echo htmlentities($row['Challname'])?></td>
                                                        <td><?php echo htmlentities($row['Challoverview']); ?></td>
                                                        <td><?php echo htmlentities($row['Challdescription']); ?></td>
                                                        <td><a href = "<?php echo htmlentities($row['Challfolder']) ; ?>"class="btn btn-outline-success">Dowload</td>
                                                        <td><a href ="submit.php?idChall=<?php echo htmlentities($row['idChall']); ?>" class="btn btn-primary">Submit</a></td>
                                                        <?php if (isset($_SESSION['role']) && ( $_SESSION['role'] == 'teacher')) { ?>
                                                        <td><a href ="delete_user.php?idChall=<?php echo htmlentities($row['idChall']); ?>" class="btn btn-danger">Delete</a></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
            <script src="./assets/vendor/global/global.min.js"></script>
            <script src="./assets/js/quixnav-init.js"></script>
            <script src="./assets/js/custom.min.js"></script>
            <script src="./assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
            <script src="./assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
            <script src="./assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
            <script src="./assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>
            <script src="./assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
</body>

</html>