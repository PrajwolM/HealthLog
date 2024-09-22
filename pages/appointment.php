<?php include '../layouts/header.php' ?>
<?php
include 'connection.php';
session_start();

$sql = "SELECT appointments.appointmentId, doctorinfo.name AS doctorName, patientinfo.pName AS patientName, appointments.appointmentDate 
        FROM appointments
        INNER JOIN doctorInfo ON appointments.did = doctorinfo.did
        INNER JOIN patientInfo ON appointments.pid = patientinfo.pid";

if (isset($_SESSION['userName'])) {
    // Admin sees all appointments grouped by doctor
    $sql .= " ORDER BY doctorinfo.name";
} elseif (isset($_SESSION['did'])) {
    // Doctor sees only their specific appointments
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
        <button class="btn btn-outline-secondary" onclick="window.history.back();">Back</button>
        <a href="login.php" class="btn btn-outline-danger logout-btn">Logout</a>
        <h2>Appointments Management</h2>


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