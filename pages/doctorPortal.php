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
    <button>
        Add Appointment
    </button> <button>

        See Patient Details
    </button> <button>
        Update Patient Details
    </button>
    <button>
        Remove Patient Data
    </button>
    <table border="2">
        <thead>
            <th>Patient's ID</th>
            <th>
                Name
            </th>
            <th>Date of Birth</th>
            <th>
                Allergies

            </th>
        </thead>
        <tbody>
            <?php
            include "connection.php";

            $query = 'SELECT * FROM patientinfo';
            $result = mysqli_query($conn, $query);

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row in the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
            <td>' . $row['pid'] . '</td>
            <td>' . $row['pName'] . '</td>
            <td>' . $row['pDOB'] . '</td>
            <td>' . $row['pAllergies'] . '</td>
          </tr>';
                }
            } else {
                echo "<tr><td colspan='4'>No doctors found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>