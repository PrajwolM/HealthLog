<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'healthlogdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variable to store success or error message
$message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $specialization = $_POST['specialization'];

    // Fetch the last did from the doctorlogin table
    $sql_get_last_did = "SELECT did FROM doctorlogin ORDER BY did DESC LIMIT 1";
    $result = $conn->query($sql_get_last_did);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_did = $row['did'];

        // Extract the numeric part from the last did
        $numeric_part = (int) substr($last_did, 1); // Extract numeric part, assuming format like 'D0866'
        $new_numeric_part = $numeric_part + 1; // Increment the number

        // Format the new did (e.g., 'D0867')
        $new_did = 'D' . str_pad($new_numeric_part, 4, '0', STR_PAD_LEFT); // Ensuring 4 digits
    } else {
        // If no previous did, start with 'D0001'
        $new_did = 'D0001';
    }

    // Fetch the last password from the doctorlogin table
    $sql_get_last_password = "SELECT password FROM doctorlogin ORDER BY did DESC LIMIT 1";
    $result_password = $conn->query($sql_get_last_password);

    if ($result_password->num_rows > 0) {
        $row_password = $result_password->fetch_assoc();
        $last_password = $row_password['password'];

        // Extract the numeric part from the last password
        preg_match('/\d+/', $last_password, $matches);
        $num = (int) $matches[0] + 1; // Increment the number
    } else {
        // If no previous password, start from 5
        $num = 5;
    }

    // Create the new password
    $new_password = "doctor" . $num;

    // Insert data into doctorlogin table first
    $sql_insert_login = "INSERT INTO doctorlogin (did, password) VALUES ('$new_did', '$new_password')";

    if ($conn->query($sql_insert_login) === TRUE) {
        // Now insert data into doctorinfo table with the new `did`
        $sql_insert_doctor = "INSERT INTO doctorinfo (did, name, surname, gender, specialization) 
                              VALUES ('$new_did', '$name', '$surname', '$gender', '$specialization')";

        if ($conn->query($sql_insert_doctor) === TRUE) {
            $message = "Doctor added successfully!";
        } else {
            $message = "Error inserting into doctorinfo: " . $conn->error;
        }
    } else {
        $message = "Error inserting into doctorlogin: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
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
        <h2>Add Doctor Information</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="addDoctor.php" method="POST">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization" required>

            <input type="submit" value="Add Doctor">
        </form>
    </div>

</body>

</html>