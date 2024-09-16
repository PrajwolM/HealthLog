<?php
// Database connection
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "healthlogdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $conn->real_escape_string($_POST['delete_id']);
    $sql_delete = "DELETE FROM inquiries WHERE inquiryId = '$delete_id'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Inquiry deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all inquiries from the database
$sql = "SELECT inquiryId, iname, iemail, icontact, inquiry FROM inquiries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Inquiries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .inquiry-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .inquiry-card {
            background-color: #fff;
            width: 300px;
            margin: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease;
        }

        .inquiry-card:hover {
            transform: scale(1.05);
        }

        .inquiry-card h3 {
            margin-top: 0;
            color: #333;
        }

        .inquiry-card p {
            color: #555;
        }

        .inquiry-card .contact-info {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 10px;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            color: #555;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
        }

        .delete-btn:hover {
            color: #d00;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">All Inquiries</h2>

    <div class="inquiry-container">
        <?php
        if ($result->num_rows > 0) {
            // Output each inquiry as a card
            while ($row = $result->fetch_assoc()) {
                echo "<div class='inquiry-card'>";
                echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this inquiry?\");'>";
                echo "<input type='hidden' name='delete_id' value='" . htmlspecialchars($row["inquiryId"]) . "'>";
                echo "<button class='delete-btn' type='submit'>X</button>";
                echo "</form>";
                echo "<h3>" . htmlspecialchars($row["iname"]) . "</h3>";
                echo "<p class='contact-info'><strong>Email:</strong> " . htmlspecialchars($row["iemail"]) . "<br>";
                echo "<strong>Contact:</strong> " . htmlspecialchars($row["icontact"]) . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($row["inquiry"])) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No inquiries found.</p>";
        }
        ?>
    </div>

    <?php
    // Close connection
    $conn->close();
    ?>

</body>

</html>