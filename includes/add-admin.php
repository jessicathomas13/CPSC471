<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];
    $name = $_POST["name"];
    $branchId = $_POST["branch_id"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Check if the employee ID already exists in the database
    $stmt_check = $con->prepare("SELECT * FROM admin WHERE EmpID = ?");
    $stmt_check->bind_param("s", $employeeId);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Error: Employee ID already exists in the database.";
    } else {
        $stmt_insert = $con->prepare("INSERT INTO admin (Name, EmpID, BranchID, Password, EmailID) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssss", $name, $employeeId, $branchId, $password, $email);

        if ($stmt_insert->execute()) {
            $message = "Admin added successfully!";
            echo "<script>alert('Admin added successfully!');</script>";
            echo "<script>window.location.href='all-admins.php'</script>";
        } else {
            $message = "Error: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    }
    $stmt_check->close();
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
    .container {
      padding-top: 50px;
    }
    .alert {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="text-center">Add Admin</h1>
    <div class="card border-left-primary shadow h-1000 py-10">
      <div class="card-body">
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
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
            <label for="branch_id">Branch:</label>
            <select class="form-control" name="branch_id" required="required">
            <option value="">Select Branch</option>
            <?php
              $sql = "SELECT * from  branch ";
              $result = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_assoc($result)){
                echo "<option value='".htmlspecialchars($row['BranchID'])."'>".htmlspecialchars($row['Branch Name'])."</option>";
              } 
            ?>
            </select>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" type="password" id="password" name="password" required autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
