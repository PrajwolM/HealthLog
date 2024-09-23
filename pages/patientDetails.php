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

$query = "
    SELECT 
        * ,
        doctorinfo.name AS doctorName,
        doctorinfo.surname AS doctorSurname,
        doctorinfo.specialization,
        appointments.appointmentDate
    FROM patientinfo
    INNER JOIN doctorpatient ON patientinfo.pid = doctorpatient.pid
    INNER JOIN doctorinfo ON doctorpatient.did = doctorinfo.did
    LEFT JOIN appointments ON patientinfo.pid = appointments.pid
    WHERE patientinfo.pid = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $pid);
$stmt->execute();
$patientResult = $stmt->get_result();

if ($patientResult->num_rows > 0) {
    $patientData = $patientResult->fetch_assoc();
} else {
    echo "No patient found.";
    exit();
}

$testQuery = "
    SELECT pt.tid, pt.complete, pt.result, t.tname 
    FROM patienttest pt
    INNER JOIN tests t ON pt.tid = t.tid
    WHERE pt.pid = ?
";

$testStmt = $conn->prepare($testQuery);
$testStmt->bind_param("s", $pid);
$testStmt->execute();
$testResult = $testStmt->get_result();

$completedTests = [];
$remainingTests = [];

while ($testRow = $testResult->fetch_assoc()) {
    if ($testRow['complete'] == 1) {
        $completedTests[] = $testRow;
    } else {
        $testRow['result'] = 'Pending';
        $remainingTests[] = $testRow;
    }
}

$stmt->close();
$testStmt->close();
$conn->close();
?>


<section class="patient-details">
    <div class="container">
        <div class="no-print">
            <button class="btn btn-secondary mb-3" onclick="window.location.href='../pages/doctorPage.php';">Back</button>
            <button class="btn btn-primary mb-3" onclick="printPage();">Print Patient Details</button>
        </div>

        <h2>Patient Details for <?php echo htmlspecialchars($patientData['pName']); ?></h2>
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($patientData['phoneNumber']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($patientData['pGender']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($patientData['pDOB']); ?></p>
                <p><strong>Allergies:</strong> <?php echo htmlspecialchars($patientData['pAllergies'] == 1 ? 'Yes' : 'No'); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Doctor:</strong> <?php echo htmlspecialchars($patientData['doctorName'] . ' ' . $patientData['doctorSurname']); ?></p>
                <p><strong>Specialization:</strong> <?php echo htmlspecialchars($patientData['specialization']); ?></p>
                <p><strong>Appointment Date:</strong> <?php echo htmlspecialchars($patientData['appointmentDate']); ?></p>
            </div>
        </div>

        <h3>Remaining Tests</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Test ID</th>
                    <th scope="col">Test Name</th>
                    <th scope="col">Result</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($remainingTests) > 0): ?>
                    <?php foreach ($remainingTests as $test): ?>
                        <tr>
                            <td scope="row"><?php echo htmlspecialchars($test['tid']); ?></td>
                            <td><?php echo htmlspecialchars($test['tname']); ?></td>
                            <td><?php echo htmlspecialchars($test['result']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No remaining tests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Completed Tests</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Test ID</th>
                    <th>Test Name</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($completedTests) > 0): ?>
                    <?php foreach ($completedTests as $test): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($test['tid']); ?></td>
                            <td><?php echo htmlspecialchars($test['tname']); ?></td>
                            <td><?php echo htmlspecialchars($test['result']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No completed tests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="no-print">
            <button class="btn btn-primary" onclick="window.location.href='updatePatientData.php?pid=<?php echo htmlspecialchars($pid); ?>';">
                Update Patient Data
            </button>
        </div>
    </div>
</section>

<script>
    function printPage() {
        window.print();
    }
</script>






