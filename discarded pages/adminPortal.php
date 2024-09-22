<?php
session_start();
if (!isset($_SESSION['userName']) && !isset($_SESSION['did'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . (isset($_SESSION['userName']) ? $_SESSION['userName'] : $_SESSION['did']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminPortal</title>
</head>

<body>
    <button onclick="window.location.href='viewAppointments.php';">
        View Appointments
    </button>
    <button onclick="window.location.href='seeInquiries.php';">
        View Inquiries
    </button>
    <button onclick="window.location.href='addDoctor.php';">

        Add doctor
    </button>
    <button onclick="window.location.href='removeDoctor.php';">


        Remove Doctor
    </button>
    <button onclick="window.location.href='addNewTest.php';">

        Add Test
    </button>
    <table border="2">
        <thead>
            <th>Doctor's ID</th>
            <th>
                Name
            </th>
            <th>Surname</th>
            <th>
                Specialization

            </th>
        </thead>
        <tbody>
            <?php
            include "connection.php";

            $query = 'SELECT * FROM doctorinfo';
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                // Loop through each row in the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
            <td>' . $row['did'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['surname'] . '</td>
            <td>' . $row['specialization'] . '</td>
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