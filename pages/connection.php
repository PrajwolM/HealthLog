<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "healthlogdb";

if (!$conn = mysqli_connect($host, $user, $pass, $db))
    die("Connection Error" . mysqli_connect_error());



?>