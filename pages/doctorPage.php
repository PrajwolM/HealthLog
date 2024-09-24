<?php
include '../layouts/header.php';
session_start();
if (!isset($_SESSION['userName']) && !isset($_SESSION['did'])) {
    header("Location: login.php");
    exit();
}

include "connection.php";
$did = $_SESSION['did'];

if (isset($_GET['delete_tid'])) {
    $delete_tid = $_GET['delete_tid'];
    $deleteQuery = "DELETE FROM patienttest WHERE tid = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("s", $delete_tid);
    $deleteStmt->execute();
    $deleteStmt->close();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addTest'])) {
    $pid = $_POST['pid'];
    $tid = $_POST['tid'];

    $insertQuery = "INSERT INTO patienttest (pid, tid, complete, result) VALUES (?, ?, 0, 'Pending')";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $pid, $tid);
    if ($stmt->execute()) {
        $message = "Test added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$query = "SELECT patientinfo.* 
          FROM patientinfo 
          INNER JOIN doctorpatient ON patientinfo.pid = doctorpatient.pid 
          WHERE doctorpatient.did = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $did);
$stmt->execute();
$result = $stmt->get_result();

?>

<section class="doctor-portal">
    <div class="sidenav">
        <h2 class="text-center">Doctor</h2>
        <a href="#">Patients</a>
        <a href="appointment.php">Appointments</a>
    </div>

    <div class="main">
        <a href="login.php" class="btn btn-danger logout-btn">Logout</a>
        <h2>Welcome!</h2>

        <div class="mt-4">
            <a href="addPatient.php" class="btn btn-success mb-3 float-end">Add Patient</a>

            <h3>Patients</h3>
            <?php if ($message): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <th>Patient's ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Allergies</th>
                    <th>Actions</th>
                    <th>See Info</th>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                <td>' . htmlspecialchars($row['pid']) . '</td>
                                <td>' . htmlspecialchars($row['pName']) . '</td>
                                <td>' . htmlspecialchars($row['pDOB']) . '</td>
                                <td>' . htmlspecialchars($row['pAllergies'] == 1 ? 'Yes' : 'No') . '</td>
                                <td>
                                    <button  class="btn btn-primary text-light" onclick="showAddTestModal(\'' . $row['pid'] . '\')">Add Tests</button>
                                    <button  class="btn btn-danger text-light" onclick="if(confirm(\'Are you sure you want to delete this patient?\')) { window.location.href=\'deletePatient.php?pid=' . $row['pid'] . '\'; }">Delete</button>
                                </td>
                                <td>
                                    <button  class="btn btn-primary text-light" onclick="window.location.href=\'patientDetails.php?pid=' . $row['pid'] . '\';">See Info</button>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>No patients found</td></tr>";
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Add Test -->
        <div id="addTestModal" style="display:none;">
            <h2>Add Test</h2>
            <form method="POST" action="">
                <input type="hidden" name="pid" id="modalPid">
                <label for="tid">Select Test:</label>
                <select name="tid" id="tid" required>
                    <option value="">Select a test</option>
                    <?php
                    $testQuery = "SELECT tid, tname FROM tests";
                    $testResult = $conn->query($testQuery);
                    if ($testResult->num_rows > 0) {
                        while ($testRow = $testResult->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($testRow['tid']) . '">' . htmlspecialchars($testRow['tname']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No tests available</option>';
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary text-light" name="addTest">Add Test</button>
                <button type="button" class="btn btn-dark text-light"
                    onclick="document.getElementById('addTestModal').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>
</section>

<script>
    function showAddTestModal(pid) {
        document.getElementById('modalPid').value = pid;
        document.getElementById('addTestModal').style.display = 'block';
    }
</script>

<?php $conn->close(); ?>