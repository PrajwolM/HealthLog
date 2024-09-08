<?php
echo '<h1>Admin Login Successful.
</h1>';
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminPortal</title>
</head>

<body>
    <button>
        Add doctor
    </button> <button>

        See Doctors
    </button> <button>
        Update Doctors
    </button>
    <button>
        Remove Doctor
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

            // Check if there are any results
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