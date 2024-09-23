<?php
include '../layouts/header.php';
include 'connection.php';
session_start();

$sql = "SELECT appointments.appointmentId, doctorinfo.name AS doctorName, patientinfo.pName AS patientName, appointments.appointmentDate 
        FROM appointments
        INNER JOIN doctorInfo ON appointments.did = doctorinfo.did
        INNER JOIN patientInfo ON appointments.pid = patientinfo.pid";

if (isset($_SESSION['userName'])) {
    $sql .= " ORDER BY doctorinfo.name";
} elseif (isset($_SESSION['did'])) {
    $did = $_SESSION['did'];
    $sql .= " WHERE appointments.did = '$did'";
} else {
    echo "Access denied.";
    exit;
}

$result = $conn->query($sql);
?>

<section class="appointment">
    <div class="main">
        <?php if (isset($_SESSION['userName'])): ?>
            <a href="../pages/adminPage.php" class="btn btn-outline-secondary float-start">Back</a>
        <?php elseif (isset($_SESSION['did'])): ?>
            <a href="../pages/doctorPage.php" class="btn btn-outline-secondary float-start">Back</a>
            <a href="addAppointment.php" class="btn btn-success float-start ms-3">Add Appointment</a>
        <?php endif; ?>

        <h2>Appointments</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["appointmentId"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["patientName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["doctorName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["appointmentDate"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No appointments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
