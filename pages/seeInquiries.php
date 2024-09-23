

<?php
include '../layouts/header.php';

include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $conn->real_escape_string($_POST['delete_id']);
    $sql_delete = "DELETE FROM inquiries WHERE inquiryId = '$delete_id'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Inquiry deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT inquiryId, iname, iemail, icontact, inquiry FROM inquiries";
$result = $conn->query($sql);
?>

<section class="seeInquiries">
    <button class="btn btn-secondary float-start ms-5" onclick="window.location.href='../pages/adminPage.php';">Back</button> 
    <h2 class="text-center mb-4 mt-4">All Inquiries</h2>

    <div class="container">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Inquiry</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["iname"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["iemail"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["icontact"]) . "</td>";
                        echo "<td>" . nl2br(htmlspecialchars($row["inquiry"])) . "</td>";
                        echo "<td>";
                        echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this inquiry?\");'>";
                        echo "<input type='hidden' name='delete_id' value='" . htmlspecialchars($row["inquiryId"]) . "'>";
                        echo "<button class='btn btn-danger btn-sm' type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No inquiries found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $conn->close();
    ?>

</section>
