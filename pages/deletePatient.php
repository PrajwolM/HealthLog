<?php
include "connection.php";
session_start();

// Check if pid is set in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    mysqli_begin_transaction($conn);
    // Delete from patientinfo because it is has the pid as primary key others are foreign key.
    try {
        $stmt1 = $conn->prepare("DELETE FROM appointments WHERE pid = ?");
        $stmt1->bind_param("s", $pid);
        $stmt1->execute();

        $stmt2 = $conn->prepare("DELETE FROM patienttest WHERE pid = ?");
        $stmt2->bind_param("s", $pid);
        $stmt2->execute();

        $stmt3 = $conn->prepare("DELETE FROM doctorpatient WHERE pid = ?");
        $stmt3->bind_param("s", $pid);
        $stmt3->execute();

        $stmt4 = $conn->prepare("DELETE FROM patientinfo WHERE pid = ?");
        $stmt4->bind_param("s", $pid);
        $stmt4->execute();

        mysqli_commit($conn);

        header("Location: doctorPage.php?msg=Patient deleted successfully");
        exit();
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error deleting patient: " . $e->getMessage();
    }
} else {
    echo "No patient ID provided.";
}

$conn->close();
?>