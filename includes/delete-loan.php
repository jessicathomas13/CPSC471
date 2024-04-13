<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = ''; // Initialize message variable to empty

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookID = $_POST["bookID"];
    $adminPassword = $_POST["adminPassword"]; // Placeholder for admin password

    // Here we should ideally have the admin password stored securely, not plaintext
    $expectedAdminPassword = "adminPass"; // This should be the actual admin password

    // Check if admin password is correct
    if ($adminPassword === $expectedAdminPassword) {
        // Admin password is correct, proceed with loan deletion
        $delete_query = "DELETE FROM loan WHERE BookID = ?";
        $delete_stmt = $con->prepare($delete_query);
        $delete_stmt->bind_param("i", $bookID);
        $delete_stmt->execute();

        if ($delete_stmt->affected_rows > 0) {
            // Loan was deleted successfully
            $message = "Loan deleted successfully. You will be redirected shortly.";
            echo $message;
            header("Refresh: 2; URL=user-details.php");
            exit;
        } else {
            // Loan does not exist or couldn't be deleted
            $message = "No loan found with that book ID or unable to delete.";
        }
        $delete_stmt->close();
    } else {
        // Admin password is incorrect
        $message = "Incorrect admin password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Loan</title>
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
        <h1>Delete Loan</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="bookID">Book ID:</label>
                <input type="text" id="bookID" name="bookID" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adminPassword">Admin Password:</label>
                <input type="password" id="adminPassword" name="adminPassword" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Delete Loan" class="btn btn-danger">
            </div>
        </form>
    </div>
</body>
</html>
