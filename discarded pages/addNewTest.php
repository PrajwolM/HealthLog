<?php
session_start();

// Ensure only admin has access to this page
if (!isset($_SESSION['userName'])) {
    // Redirect if not logged in as admin
    header("Location: login.php");
    exit();
}

include "connection.php";

// Function to generate the next tid
function generateNextTid($conn)
{
    $query = "SELECT tid FROM tests ORDER BY tid DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTid = $row['tid'];

        $lastNumber = intval(substr($lastTid, 1));
        $newNumber = $lastNumber + 1;

        // Tests are in the format 'T001'
        return 'T' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        // If no records, start with T001
        return 'T001';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tname = $_POST['tname'];

    $newTid = generateNextTid($conn);

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

    <button onclick="window.location.href='adminPage.php';">Back to Admin Portal</button>

</body>

</html>

<?php
$conn->close();
?>