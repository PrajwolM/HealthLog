<?php

include 'connection.php';  

$sql = "SELECT COUNT(*) AS total FROM appointments";
$result = $conn->query($sql);

$appointmentCount = 0;

if ($result) { 
    $row = $result->fetch_assoc();
    $appointmentCount = $row['total'];  
} else {
    echo "Error retrieving appointment count: " . $conn->error;
}

$conn->close(); ?>