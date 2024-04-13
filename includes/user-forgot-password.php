<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $con->prepare("SELECT COUNT(*) AS count FROM user WHERE emailID = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        // Simulate sending email (replace with your actual reset password email sending code)
        $resetLink = "http://localhost/reset-password.php?email=" . urlencode($email);
        $emailBody = "Click the following link to reset your password: " . $resetLink;
        $subject = "Password Reset";

        // Send the email to MailHog (localhost SMTP)
        $to = $email;
        $headers = "From: your-email@example.com"; // Replace with your email
        mail($to, $subject, $emailBody, $headers);

        echo "Email sent.";
    } else {
        echo "Email is not associated with any account.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="assets/bootstrap.css">
</head>
<body>
<div class="container">
    <h1>Forgot Password</h1>
    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
</body>
</html>
