<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardno = $_POST["cardno"];
    $branchId = $_POST["branch_id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phone_number"];
    $email = $_POST["email"]; // Add email field
    $password = $_POST["password"]; // If users have a password
    $status = 1;

    // Check if the card number already exists in the database
    $sql_check = "SELECT * FROM user WHERE Cardno = '$cardno'";
    $result_check = mysqli_query($con, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $message = "Card number already exists in the database.";
    } else {
        $sql_insert = "INSERT INTO user (Cardno, BranchID, Name, Address, `Phone no.`, EmailID, Password, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql_insert);
        $stmt->bind_param("sssssssi", $cardno, $branchId, $name, $address, $phoneNumber, $email, $password, $status);

        if ($stmt->execute()) {
            $message = "User added successfully! You will be redirected shortly.";
            echo $message;
            header("Refresh: 2; URL=users.php");
            exit;
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
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
    .btn-primary {
        width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Add User</h1>
    <!-- Display message here, right under the page header and above the form -->
    <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
    <form action="add-user.php" method="POST">
      <div class="form-group">
        <label for="cardno">Card Number</label>
        <input type="text" id="cardno" name="cardno" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="branch_id">Branch ID</label>
        <input type="text" id="branch_id" name="branch_id" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" id="phone_number" name="phone_number" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label> <!-- Add email field -->
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Add User" class="btn btn-primary">
      </div>
    </form>
  </div>
</body>
</html>
