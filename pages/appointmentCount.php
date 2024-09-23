<?php

include 'connection.php';  // Ensure the connection file is properly included

// Query to count the number of appointments
$sql = "SELECT COUNT(*) AS total FROM appointments";
$result = $conn->query($sql);

// Initialize appointment count
$appointmentCount = 0;

if ($result) { // Check if the query was successful
    $row = $result->fetch_assoc();
    $appointmentCount = $row['total'];  // Store the count in a variable
} else {
    echo "Error retrieving appointment count: " . $conn->error;
}

// Close the connection after use
$conn->close(); ?>