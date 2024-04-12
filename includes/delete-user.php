<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = ''; // Initialize message variable to empty

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardno = $_POST["cardno"];
    $password = $_POST["password"]; // Assuming users have a password

    // First, we check if the card number exists
    $query = "SELECT Password FROM user WHERE Cardno = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $cardno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Card number exists, now we check the password
        if ($password === $row['Password']) {
            // Password is correct, proceed with deletion
            $delete_query = "DELETE FROM user WHERE Cardno = ?";
            $delete_stmt = $con->prepare($delete_query);
            $delete_stmt->bind_param("s", $cardno);
            $delete_stmt->execute();

            if ($delete_stmt->affected_rows > 0) {
                // User was deleted successfully
                $message = "User Deleted Successfully. You will be redirected shortly.";
                echo $message;
                header("Refresh: 2; URL=users.php");
                exit;
            } else {
                // User exists but couldn't be deleted
                $message = "No user found with that card number or unable to delete.";
            }
            $delete_stmt->close();
        } else {
            // Password is incorrect
            $message = "Incorrect password.";
        }
    } else {
        // Card number does not exist
        $message = "No user found with that card number.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-danger {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="cardno">Card Number:</label>
                <input type="text" id="cardno" name="cardno" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Delete" class="btn btn-danger">
            </div>
        </form>
    </div>
</body>
</html>
