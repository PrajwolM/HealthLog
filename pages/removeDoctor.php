<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'healthlogdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $did = $_POST['did'];

    // SQL to delete from appointments and doctorpatient tables first
    $sql_delete_appointments = "DELETE FROM appointments WHERE did='$did'";
    $sql_delete_doctorpatient = "DELETE FROM doctorpatient WHERE did='$did'";
    $sql_delete_info = "DELETE FROM doctorinfo WHERE did='$did'";
    $sql_delete_login = "DELETE FROM doctorlogin WHERE did='$did'";

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Execute deletion queries
        $conn->query($sql_delete_appointments);
        $conn->query($sql_delete_doctorpatient);
        $conn->query($sql_delete_info);
        $conn->query($sql_delete_login);

        // Commit transaction
        $conn->commit();
        echo "<p>Doctor and related records deleted successfully!</p>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "<p>Error deleting records: " . $e->getMessage() . "</p>";
    }
}

// Fetch all doctors from the doctorinfo table
$sql_fetch_doctors = "SELECT did, name FROM doctorinfo";
$result = $conn->query($sql_fetch_doctors);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Doctor</title>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this doctor?");
        }
    </script>
</head>

<body>

    <h2>Select a Doctor to Delete</h2>

    <form action="removeDoctor.php" method="POST" onsubmit="return confirmDeletion()">
        <label for="did">Select Doctor:</label>
        <select name="did" id="did" required>
            <option value="" disabled selected>Select a doctor</option>
            <?php
            if ($result->num_rows > 0) {
                // Output options with doctor IDs
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['did'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No doctors found</option>";
            }
            ?>
        </select>

        <br><br>
        <input type="submit" value="Delete Doctor">
    </form>

</body>

</html>