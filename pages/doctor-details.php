<?php include '../layouts/nav.php'; ?>
<?php
include 'connection.php';

$sql = "SELECT name, specialization FROM doctorinfo";
$result = $conn->query($sql);
?>

<section class="doctor">
    <div class="container-fluid">
        <div class="banner">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <h1>Your Health, <br> Our Expert Team</h1>
                    <p>At HealthLogs, we believe that your health deserves the highest standard of care. Our dedicated
                        team of experts is here to support you every step of the way, providing personalized,
                        compassionate, and comprehensive services tailored to your unique needs.</p>
                </div>
                <div class="col-lg-5 col-md-5">
                    <img src="../images/slider2.jpg" alt="doctor-banner">
                </div>
            </div>
        </div>

        <h2>Meet Our Dedicated Medical Team</h2>
        <div class="teams row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card" style="width: 18rem;">
                            <img src="../images/doc.jpg" class="card-img-top" alt="doctor-image">
                            <div class="card-body row">
                                <div class="col-6">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">' . $row["name"] . '</h6>    
                                </div>
                                <div class="col-6">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">' . $row["specialization"] . '</h6>                
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No doctors found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php
$conn->close();
?>
<?php include '../layouts/footer.php'; ?>