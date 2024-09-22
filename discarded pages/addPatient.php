<?php
session_start();
if (!isset($_SESSION['did'])) {
    header("Location: login.php"); // Redirect to login if no session is set
    exit();
}

include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pName = $_POST['pName'];
    $phoneNumber = $_POST['phoneNumber'];
    $pGender = $_POST['pGender'];
    $pDOB = $_POST['pDOB'];
    $pAllergies = $_POST['pAllergies'];
    $did = $_SESSION['did']; // Doctor's ID from session

    // Fetch the last pid from the patientinfo table
    $sql_get_last_pid = "SELECT pid FROM patientinfo ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($sql_get_last_pid);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_pid = $row['pid'];

        // Get the numeric part from the last pid
        $numeric_part = (int) substr($last_pid, 1);
        $new_numeric_part = $numeric_part + 1;

        // id in the format P001
        $new_pid = 'P' . str_pad($new_numeric_part, 3, '0', STR_PAD_LEFT);
    } else {
        $new_pid = 'P001';
    }

    // add patient data into patientinfo table first because pid is teh primary key in this table
    $sql_insert_patient = "INSERT INTO patientinfo (pid, pName, phoneNumber, pGender, pDOB, pAllergies) 
                           VALUES ('$new_pid', '$pName', '$phoneNumber', '$pGender', '$pDOB', '$pAllergies')";

    if ($conn->query($sql_insert_patient) === TRUE) {
        // Also add into doctorpatient table
        $sql_insert_doctorpatient = "INSERT INTO doctorpatient (did, pid) VALUES ('$did', '$new_pid')";

        if ($conn->query($sql_insert_doctorpatient) === TRUE) {
            $message = "Patient added successfully!";
        } else {
            $message = "Error inserting into doctorpatient: " . $conn->error;
        }
    } else {
        $message = "Error inserting into patientinfo: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #218838;
        }

        .message {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Add Patient Information</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="addPatient.php" method="POST">
            <label for="pName">Name:</label>
            <input type="text" id="pName" name="pName" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>

            <label for="pGender">Gender:</label>
            <select id="pGender" name="pGender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="pDOB">Date of Birth:</label>
            <input type="date" id="pDOB" name="pDOB" required>

            <label for="pAllergies">Allergies:(0 for no and 1 for yes)</label>
            <input type="text" id="pAllergies" name="pAllergies">

            <input type="submit" value="Add Patient">
        </form>
    </div>
</body>

</html>