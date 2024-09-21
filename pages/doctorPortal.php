<?php
session_start();
if (!isset($_SESSION['userName']) && !isset($_SESSION['did'])) {
    header("Location: loginPage.php"); // Redirect to login if no session is set
    exit();
}

// Use session data
echo "Welcome, " . (isset($_SESSION['userName']) ? $_SESSION['userName'] : $_SESSION['did']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoctorPortal</title>
</head>

<body>
    <button onclick="window.location.href='addAppointment.php';">Add Appointment</button>
    <button onclick="window.location.href='viewAppointments.php';">View Appointments</button>
    <button onclick="window.location.href='addPatient.php';">

        Add Patient
    </button>

    <table border="2">
        <thead>
            <tr>
                <th>Patient's ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Allergies</th>
                <th>Actions</th>
                <th>Details</th> <!-- New Actions column -->
            </tr>
        </thead>
        <tbody>
            <?php
            include "connection.php";

            // Get the doctor's ID from the session
            $did = $_SESSION['did'];

            // Update the query to filter by doctor's ID
            $query = "SELECT patientinfo.* 
                      FROM patientinfo 
                      INNER JOIN doctorpatient ON patientinfo.pid = doctorpatient.pid 
                      WHERE doctorpatient.did = ?";

            // Prepare and execute the query
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $did); // Assuming did is a string
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Loop through each row in the result
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                        <td>' . htmlspecialchars($row['pid']) . '</td>
                        <td>' . htmlspecialchars($row['pName']) . '</td>
                        <td>' . htmlspecialchars($row['pDOB']) . '</td>
                        <td>' . htmlspecialchars($row['pAllergies']) . '</td>
                        <td> 
                            <button onclick="{ window.location.href=\'addTest.php?pid=' . $row['pid'] . '\'; }">Add Tests</button>
                            <button onclick="if(confirm(\'Are you sure you want to delete this patient?\')) { window.location.href=\'deletePatient.php?pid=' . $row['pid'] . '\'; }">Delete</button>
                            
                        </td>
                        <td>
                        <button onclick="window.location.href=\'patientDetails.php?pid=' . $row['pid'] . '\';">See Info</button></td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No patients found</td></tr>";
            }

            // Close the statement
            $stmt->close();
            ?>
        </tbody>
    </table>
</body>

</html>