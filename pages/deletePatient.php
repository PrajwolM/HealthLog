<?php
include "connection.php";
session_start();

// Check if pid is set in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Use prepared statements to prevent SQL injection
    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete from appointments
        $stmt1 = $conn->prepare("DELETE FROM appointments WHERE pid = ?");
        $stmt1->bind_param("s", $pid);
        $stmt1->execute();

        // Delete from patienttest
        $stmt2 = $conn->prepare("DELETE FROM patienttest WHERE pid = ?");
        $stmt2->bind_param("s", $pid);
        $stmt2->execute();

        // Delete from doctorpatient
        $stmt3 = $conn->prepare("DELETE FROM doctorpatient WHERE pid = ?");
        $stmt3->bind_param("s", $pid);
        $stmt3->execute();

        // Delete from patientinfo
        $stmt4 = $conn->prepare("DELETE FROM patientinfo WHERE pid = ?");
        $stmt4->bind_param("s", $pid);
        $stmt4->execute();

        // Commit transaction
        mysqli_commit($conn);

        // Redirect back with a success message
        header("Location: doctorPortal.php?msg=Patient deleted successfully");
        exit();
    } catch (Exception $e) {
        // Rollback transaction in case of error
        mysqli_rollback($conn);
        echo "Error deleting patient: " . $e->getMessage();
    }
} else {
    echo "No patient ID provided.";
}

// Close connection
$conn->close();
?>