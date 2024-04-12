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
    $password = $_POST["password"]; // If users have a password
    $status = 1;

    // Check if the card number already exists in the database
    $sql_check = "SELECT * FROM user WHERE Cardno = '$cardno'";
    $result_check = mysqli_query($con, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $message = "Error: Card number already exists in the database.";
    } else {
        $sql_insert = "INSERT INTO user (Cardno, BranchID, Name, Address, `Phone no.`, Password, Status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql_insert);
        $stmt->bind_param("ssssssi", $cardno, $branchId, $name, $address, $phoneNumber, $password, $status);

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
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .card {
      box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
      -webkit-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
      -moz-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
      border: 0px solid black!important;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Add User</h1>
    <div class="card border-left-primary shadow h-1000 py-10">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
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
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" value="Add User" class="btn btn-primary">
              </div>
            </form>
            <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
