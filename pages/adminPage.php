<?php include '../layouts/header.php' ?>
<?php
session_start();
if (!isset($_SESSION['userName']) && !isset($_SESSION['did'])) {
    header("Location: login.php");
    exit();
}
include '../pages/appointmentCount.php';
?>


<section class="admin">
    <div class="sidenav">
        <h2 class="text-center">Admin</h2>
        <a href="appointment.php">Appointments</a>
        <a href="doctor.php">Doctor</a>
        <!-- <a href="addDoctor.php">Add Doctor</a>
        <a href="removeDoctor.php">Remove Doctor</a> -->
        <a href="addNewTest.php">Add Tests</a>
        <a href="seeInquiries.php">Inquiries</a>
    </div>

    <div class="main">
        <a href="login.php" class="btn btn-danger logout-btn">Logout</a>
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Appointments</h5>
                        <p class="card-text"><?php echo $appointmentCount; ?></p>
                        <a href="appointment.php" class="btn btn-primary">View Appointments</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <h3>Doctors</h3>
            <table class="table">
                <thead>
                    <th>Doctor's ID</th>
                    <th>
                        Name
                    </th>
                    <th>Surname</th>
                    <th>
                        Specialization

                    </th>
                </thead>
                <tbody>
                    <?php
                    include "connection.php";

                    $query = 'SELECT * FROM doctorinfo';
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
            <td>' . $row['did'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['surname'] . '</td>
            <td>' . $row['specialization'] . '</td>
          </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='4'>No doctors found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>