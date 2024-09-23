<?php
include '../layouts/header.php';

include 'connection.php';
session_start();

$doctorId = $_SESSION['did'];
$patients_sql = "SELECT pid, pName FROM patientInfo";
$patients_result = $conn->query($patients_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $conn->real_escape_string($_POST['patient']);
    $appointmentDate = $conn->real_escape_string($_POST['appointmentDate']);

    $sql = "INSERT INTO appointments (did, pid, appointmentDate) VALUES ('$doctorId', '$pid', '$appointmentDate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Appointment added successfully!');
                window.location.href = 'appointment.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>

<section class="addAppointment">

    <h2 style="text-align: center;">Add Appointment</h2>

    <form method="POST">
        <label for="patient">Select Patient</label>
        <select name="patient" id="patient" required>
            <option value="">-- Select Patient --</option>
            <?php
            if ($patients_result->num_rows > 0) {
                while ($row = $patients_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['pid']) . "'>" . htmlspecialchars($row['pName']) . "</option>";
                }
            } else {
                echo "<option value=''>No patients available</option>";
            }
            ?>
        </select>


        <label for="appointmentDate">Appointment Date</label>
        <input type="date" name="appointmentDate" id="appointmentDate" required>

        <input type="submit" value="Add Appointment">
    </form>

    <?php
    $conn->close();
    ?>

</section>

