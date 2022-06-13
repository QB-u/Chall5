<?php
    include 'session.php';
    include 'ConnectDB.php';
    if (isset($_GET['id']) && $_SESSION['role'] = 'teacher'){
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $sql = "DELETE FROM UserInformation WHERE id = $id";
        $result = $conn -> query($sql);
        if ($result) {
            echo "<script>alert('Delete success');</script>";
            header ('Location: student.php');
        }
        else {
            echo "<script>alert('Delete fail');</script>";
            header ('Location: student.php');
        }
    }
    if (isset ($_GET['idChall']) && $_SESSION['role'] == 'teacher') {
        $id = mysqli_real_escape_string($conn,$_GET['idChall']);
        $sql = "DELETE FROM Chall WHERE idChall = $id";
        $result = $conn -> query($sql);
        if ($result) {
            echo "<script>alert('Delete success');</script>";
            header ('Location: exercise.php');
        }
        else {
            echo "<script>alert('Delete fail');</script>";
            header ('Location: exercise.php');
        }
    }
    if (isset ($_GET['idsubmit']) && $_SESSION['role'] == 'teacher') {
        $id = mysqli_real_escape_string($conn,$_GET['idsubmit']);
        $sql = "DELETE FROM submit WHERE idsubmit = $id";
        $result = $conn -> query($sql);
        if ($result) {
            echo "<script>alert('Delete success');</script>";
            header ('Location: exercise.php');
        }
        else {
            echo "<script>alert('Delete fail');</script>";
            header ('Location: exercise.php');
        }
    }
?>