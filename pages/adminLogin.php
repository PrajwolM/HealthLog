<?php

include('connection.php');

$userName = $_POST['userName'];
$password = $_POST['password'];

$sql = "SELECT * from adminLogin where userName='$userName' and password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
print ($count);

if ($count == 1) {
    echo '<script>
        window.location.href="adminPortal.php";
    </script>';
} else {
    echo '<script>
                window.location.href="login.php";
                alert("Login Failed. Invaid username or Password.")
        </script>';
}


?>