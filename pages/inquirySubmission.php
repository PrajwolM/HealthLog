<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $iname = $conn->real_escape_string($_POST['name']);
    $iemail = $conn->real_escape_string($_POST['email']);
    $icontact = $conn->real_escape_string($_POST['contact']);
    $inquiry = $conn->real_escape_string($_POST['question']);

    $sql = "INSERT INTO inquiries (iname, iemail, icontact, inquiry) 
            VALUES ('$iname', '$iemail', '$icontact', '$inquiry')";

    if ($conn->query($sql) === TRUE) {
        echo "Inquiry submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>