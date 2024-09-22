<?php
include 'connection.php';
session_start();

$doctorId = $_SESSION['did'];
$patients_sql = "SELECT pid, pName FROM patientInfo";
$patients_result = $conn->query($patients_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $conn->real_escape_string($_POST['patient']);
    $appointmentDate = $conn->real_escape_string($_POST['appointmentDate']);

    $sql = "INSERT INTO appointments (did, pid, appointmentDate) VALUES ('$doctorId', '$pid', '$appointmentDate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Appointment added successfully!');
                window.location.href = 'doctorPortal.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select,
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Add Appointment</h2>

    <form method="POST">
        <label for="patient">Select Patient</label>
        <select name="patient" id="patient" required>
            <option value="">-- Select Patient --</option>
            <?php
            // Show all patient as option for selection
            if ($patients_result->num_rows > 0) {
                while ($row = $patients_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['pid']) . "'>" . htmlspecialchars($row['pName']) . "</option>";
                }
            } else {
                echo "<option value=''>No patients available</option>";
            }
            ?>
        </select>


        <label for="appointmentDate">Appointment Date</label>
        <input type="date" name="appointmentDate" id="appointmentDate" required>

        <input type="submit" value="Add Appointment">
    </form>

    <?php
    $conn->close();
    ?>

</body>

</html>