<?php
include 'connection.php';
session_start();

// Initialize SQL query
$sql = "SELECT appointments.appointmentId, doctorinfo.name AS doctorName, patientinfo.pName AS patientName, appointments.appointmentDate 
        FROM appointments
        INNER JOIN doctorInfo ON appointments.did = doctorinfo.did
        INNER JOIN patientInfo ON appointments.pid = patientinfo.pid";

// Check if user is logged in as admin
if (isset($_SESSION['userName'])) {
    // Admin sees all appointments grouped by doctor
    $sql .= " ORDER BY doctorinfo.name"; // Optional: Order by doctor name
} elseif (isset($_SESSION['did'])) {
    // Doctor sees only their specific appointments
    $did = $_SESSION['did'];
    $sql .= " WHERE appointments.did = '$did'";
} else {
    // Redirect or show an error if not logged in
    echo "Access denied.";
    exit;
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Appointments</h2>

    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Appointment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output each appointment
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["appointmentId"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["doctorName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["patientName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["appointmentDate"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No appointments found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close connection
    $conn->close();
    ?>

</body>

</html>