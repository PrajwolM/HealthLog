<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry</title>
</head>

<body>
    <div class="form-container">
        <h2>Inquiry Form</h2>
        <form action="inquirySubmission.php" method="POST">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="question">Your Question:</label>
                <textarea id="question" name="question" required></textarea>
            </div>
            <div>
                <button type="submit">Submit Inquiry</button>
            </div>
        </form>
    </div>

</body>

</html>