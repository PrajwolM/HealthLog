<?php
session_start();
if (!isset($_SESSION['userName']) && !isset($_SESSION['did'])) {
    header("Location: login.php");
    exit();
}

include "connection.php";

if (!isset($_GET['pid'])) {
    echo "No patient ID provided.";
    exit();
}

$pid = $_GET['pid'];

$testQuery = "
    SELECT pt.tid, pt.complete, pt.result, t.tname 
    FROM patienttest pt
    JOIN tests t ON pt.tid = t.tid 
    WHERE pt.pid = ? AND pt.complete = 0
";

$testStmt = $conn->prepare($testQuery);
$testStmt->bind_param("s", $pid);
$testStmt->execute();
$testResult = $testStmt->get_result();

$testStmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tid = $_POST['tid'];
    $result = $_POST['result'];
    $complete = isset($_POST['complete']) ? 1 : 0;

    $updateQuery = "UPDATE patienttest SET complete = ?, result = ? WHERE pid = ? AND tid = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("isss", $complete, $result, $pid, $tid);

    if ($updateStmt->execute()) {
        echo "Test data updated successfully.";
    } else {
        echo "Error updating test data: " . $conn->error;
    }

    $updateStmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Test Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h2>Update Test Data for Patient ID: <?php echo htmlspecialchars($pid); ?></h2>

    <form method="POST" action="">
        <label for="tid">Select Test:</label>
        <select name="tid" id="tid" required>
            <option value="">--Select Test--</option>
            <?php while ($testRow = $testResult->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($testRow['tid']); ?>">
                    <?php echo htmlspecialchars($testRow['tname']); ?> (Test ID:
                    <?php echo htmlspecialchars($testRow['tid']); ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label for="result">Result Comment:</label>
        <textarea name="result" id="result" placeholder="Enter the result comments here..." required></textarea>

        <label>
            <input type="checkbox" name="complete" value="1"> Mark as Complete
        </label>

        <button type="submit">Update Test Data</button>
    </form>

    <button onclick="window.location.href='patientDetails.php?pid=<?php echo htmlspecialchars($pid); ?>';">
        Back to Patient Details
    </button>

</body>

</html>