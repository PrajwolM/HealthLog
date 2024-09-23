<?php
include '../layouts/header.php';

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
        echo "<div class='alert alert-success'>Test data updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating test data: " . $conn->error . "</div>";
    }

    $updateStmt->close();
}

?>



<section class="update-patient-data mt-5">
    <div class="container">
        <h2 class="text-center">Update Test Data for Patient ID: <?php echo htmlspecialchars($pid); ?></h2>

        <form method="POST" action="" class="mb-4">
            <div class="mb-3">
                <label for="tid" class="form-label">Select Test:</label>
                <select name="tid" id="tid" class="form-select" required>
                    <option value="">--Select Test--</option>
                    <?php while ($testRow = $testResult->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($testRow['tid']); ?>">
                            <?php echo htmlspecialchars($testRow['tname']); ?> (Test ID: <?php echo htmlspecialchars($testRow['tid']); ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="result" class="form-label">Result Comment:</label>
                <textarea name="result" id="result" class="form-control" placeholder="Enter the result comments here..." required></textarea>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="complete" class="form-check-input" id="complete" value="1">
                <label class="form-check-label" for="complete">Mark as Complete</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Test Data</button>
        </form>

        <button class="btn btn-secondary" onclick="window.location.href='patientDetails.php?pid=<?php echo htmlspecialchars($pid); ?>';">
            Back to Patient Details
        </button>
    </div>
</section>
