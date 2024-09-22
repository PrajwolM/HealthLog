<?php

include('connection.php');
session_start();
$userName = $_POST['userName'];
$password = $_POST['password'];

$sql = "SELECT * from adminLogin where userName='$userName' and password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $_SESSION['userName'] = $userName;// storing admin userName in session for future use
    echo '
    <script>
        window.location.href="adminPortal.php";
    </script>';
} else {
    $query = "SELECT * from doctorlogin where did='$userName' and password='$password'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $_SESSION['did'] = $userName;// storing doctorid in session for future use
        echo '
        <script>
            window.location.href="doctorPortal.php";
        </script>';
    } else {
        echo '
            <script>
                window.location.href="loginPage.php";
                alert("Login Failed. Invaid username/id or Password.")
            </script>
            ';
    }
}


?>