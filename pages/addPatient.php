<?php
include '../layouts/header.php';

session_start();
if (!isset($_SESSION['did'])) {
    header("Location: login.php"); 
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
    $did = $_SESSION['did']; 

    $sql_get_last_pid = "SELECT pid FROM patientinfo ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($sql_get_last_pid);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_pid = $row['pid'];

        $numeric_part = (int) substr($last_pid, 1);
        $new_numeric_part = $numeric_part + 1;

        $new_pid = 'P' . str_pad($new_numeric_part, 3, '0', STR_PAD_LEFT);
    } else {
        $new_pid = 'P001';
    }

    $sql_insert_patient = "INSERT INTO patientinfo (pid, pName, phoneNumber, pGender, pDOB, pAllergies) 
                           VALUES ('$new_pid', '$pName', '$phoneNumber', '$pGender', '$pDOB', '$pAllergies')";

    if ($conn->query($sql_insert_patient) === TRUE) {
        $sql_insert_doctorpatient = "INSERT INTO doctorpatient (did, pid) VALUES ('$did', '$new_pid')";

        if ($conn->query($sql_insert_doctorpatient) === TRUE) {
             header("Location: doctorPage.php");
             exit();
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

<section class="addPatient m-5">
    <div class="form-container">
        <h2 class="text-center">Add Patient Information</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="addPatient.php" method="POST" class="container mt-4">
            <div class="mb-3">
                <label for="pName" class="form-label">Name:</label>
                <input type="text" id="pName" name="pName" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="pGender" class="form-label">Gender:</label>
                <select id="pGender" name="pGender" class="form-select" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="pDOB" class="form-label">Date of Birth:</label>
                <input type="date" id="pDOB" name="pDOB" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="pAllergies" class="form-label">Allergies (0 for No, 1 for Yes):</label>
                <input type="text" id="pAllergies" name="pAllergies" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Patient</button>
        </form>

    </div>
</section>
