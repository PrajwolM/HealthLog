<?php
session_start();
if (!isset($_SESSION['did'])) {
    header("Location: loginPage.php");
    exit();
}

include "connection.php";

// Check if pid is provided in the URL
if (!isset($_GET['pid'])) {
    echo "No patient ID provided.";
    exit();
}

$pid = $_GET['pid'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tid = $_POST['tid'];

    // Insert into patienttest with complete = 0 and result = 'Pending'
    $insertQuery = "
        INSERT INTO patienttest (pid, tid, complete, result)
        VALUES (?, ?, 0, 'Pending')
    ";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $pid, $tid); // Assuming both pid and tid are strings
    if ($stmt->execute()) {
        echo "Test added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all available tests
$testQuery = "SELECT tid, tname FROM tests";
$testResult = $conn->query($testQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Test</title>
</head>

<body>

    <h2>Add Test for Patient ID: <?php echo htmlspecialchars($pid); ?></h2>

    <form method="POST" action="">
        <label for="tid">Select Test:</label>
        <select name="tid" id="tid" required>
            <option value="">Select a test</option>
            <?php
            if ($testResult->num_rows > 0) {
                while ($row = $testResult->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['tid']) . '">' . htmlspecialchars($row['tname']) . '</option>';
                }
            } else {
                echo '<option value="">No tests available</option>';
            }
            ?>
        </select>
        <br><br>
        <button type="submit">Add Test</button>
    </form>

    <button onclick="window.location.href='doctorPortal.php';">Back to Portal</button>

</body>

</html>

<?php
$conn->close();
?>