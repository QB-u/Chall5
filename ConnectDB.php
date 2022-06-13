<?php
    $MYSQL_USERNAME="root";
    $MYSQL_PASSWORD="ISP@123";
    $MYSQL_HOST="134.209.99.18:6034";
    $MYSQL_DB="Login";
    $conn = mysqli_connect($MYSQL_HOST,$MYSQL_USERNAME,$MYSQL_PASSWORD);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    mysqli_select_db($conn,$MYSQL_DB);
?>
