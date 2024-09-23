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
    $_SESSION['userName'] = $userName;
    echo '
    <script>
        window.location.href="adminPage.php";
    </script>';
} else {
    $query = "SELECT * from doctorlogin where did='$userName' and password='$password'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $_SESSION['did'] = $userName; 
        echo '
        <script>
            window.location.href="doctorPage.php";
        </script>';
    } else {
        echo '
            <script>
                window.location.href="login.php";
                alert("Login Failed. Invaid username/id or Password.")
            </script>
            ';
    }
}


?>