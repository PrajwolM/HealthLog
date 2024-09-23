<?php
include '../layouts/header.php';
session_start();

if (!isset($_SESSION['userName'])) {
    header("Location: login.php");
    exit();
}

include "connection.php";

function generateNextTid($conn)
{
    $query = "SELECT tid FROM tests ORDER BY tid DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTid = $row['tid'];

        $lastNumber = intval(substr($lastTid, 1));
        $newNumber = $lastNumber + 1;

        
        return 'T' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        return 'T001';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tname = $_POST['tname'];

    $newTid = generateNextTid($conn);

    $insertQuery = "INSERT INTO tests (tid, tname) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ss", $newTid, $tname); 

    if ($stmt->execute()) {
        echo "New test added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>

<section class="addNewTest">
    <div class="container mt-5">
        <h2>Add New Test</h2>

        <form method="POST" action="" class="form-inline">
            <div class="form-group mb-2">
                <label for="tname" class="sr-only">Test Name:</label>
                <input type="text" class="form-control mr-2" id="tname" name="tname" placeholder="Test Name" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Add Test</button>
            <button class="btn btn-secondary mb-2" onclick="window.location.href='adminPage.php';">Back</button>

        </form>

    </div>
</section>


<?php
$conn->close();
?>