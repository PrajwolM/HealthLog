<?php
session_start();

// Ensure only admin has access
if (!isset($_SESSION['userName'])) {
    header("Location: loginPage.php"); // Redirect if not logged in as admin
    exit();
}

include "connection.php";

// Function to generate the next TID
function generateNextTid($conn)
{
    // Fetch the last TID from the tests table
    $query = "SELECT tid FROM tests ORDER BY tid DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTid = $row['tid'];

        // Extract the numeric part and increment by 1
        $lastNumber = intval(substr($lastTid, 1));
        $newNumber = $lastNumber + 1;

        // Format the new TID with leading zeros (e.g., T001, T002, ...)
        return 'T' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        // If no records, start with T001
        return 'T001';
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tname = $_POST['tname'];

    // Generate the next tid
    $newTid = generateNextTid($conn);

    // Insert the new test into the database
    $insertQuery = "INSERT INTO tests (tid, tname) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $newTid, $tname); // Bind tid and tname

    if ($stmt->execute()) {
        echo "New test added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Test</title>
</head>

<body>

    <h2>Add New Test</h2>

    <form method="POST" action="">
        <label for="tname">Test Name:</label>
        <input type="text" id="tname" name="tname" required>
        <br><br>
        <button type="submit">Add Test</button>
    </form>

    <button onclick="window.location.href='adminPortal.php';">Back to Admin Portal</button>

</body>

</html>

<?php
$conn->close();
?>