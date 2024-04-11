<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];
    $name = $_POST["name"];
    $branchId = $_POST["branch_id"];
    $filename = "all-admins.txt";

    // Check if the file exists
    if (file_exists($filename)) {
        // Read the contents of the file
        $existingAdmins = file_get_contents($filename);

        // Check if the employee ID already exists
        if (strpos($existingAdmins, $employeeId) !== false) {
            $message = "Error: Employee ID already exists.";
        } else {
            // Append the new admin to the existing contents
            $existingAdmins .= $employeeId . "," . $name . "," . $branchId . "\n";

            // Write the updated contents back to the file
            if (file_put_contents($filename, $existingAdmins) !== false) {
                $message = "Admin added successfully! You will be redirected shortly.";
                header("Refresh: 3; URL=all-admins.php");
                exit;
            } else {
                $message = "Error: Unable to write to the file.";
            }
        }
    } else {
        // Create a new file and add the new admin
        $newAdmin = $employeeId . "," . $name . "," . $branchId . "\n";
        if (file_put_contents($filename, $newAdmin) !== false) {
            $message = "Admin added successfully! You will be redirected shortly.";
            header("Refresh: 3; URL=all-admins.php");
            exit;
        } else {
            $message = "Error: Unable to create the file.";
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
  <title>Add Admin</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .card {
      box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
      -webkit-box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
      border: 0px solid black!important;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="text-center">Add Admin</h1>
    <div class="card border-left-primary shadow h-1000 py-10">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form action="add-admin.php" method="POST">
              <div class="form-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="branch_id">Branch ID:</label>
                <input type="text" id="branch_id" name="branch_id" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary">
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
