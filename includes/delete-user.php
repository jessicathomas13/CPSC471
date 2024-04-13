<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = ''; // Initialize message variable to empty
$card_numbers = []; // Initialize an array to hold the card numbers

// Fetch all card numbers from the database to populate the dropdown menu
$query = "SELECT Cardno FROM user";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $card_numbers[] = $row['Cardno'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardno = $_POST["cardno"];
    $password = $_POST["password"]; // Assuming users have a passwor

    // First, we check if the card number exists
    $query = "SELECT Password FROM admin WHERE Password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $password);
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
    <!-- Your custom styles here -->
    <style>
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="text-center mb-4">Delete User</h1>
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="cardno">Card Number:</label>
                            <select id="cardno" name="cardno" class="form-control" required>
                                <option value="">Select a card number</option>
                                <?php foreach ($card_numbers as $number): ?>
                                    <option value="<?php echo htmlspecialchars($number); ?>">
                                        <?php echo htmlspecialchars($number); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Admin Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Delete" class="btn btn-danger btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
