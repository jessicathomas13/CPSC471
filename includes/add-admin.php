<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];
    $name = $_POST["name"];
    $branchId = $_POST["branch_id"];
    $password = $_POST["password"];
    $filename = "all-admins.txt";

    // Check if the employee ID already exists in the database
    $sql_check = "SELECT * FROM admin WHERE EmpID = '$employeeId'";
    $result_check = mysqli_query($con, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $message = "Error: Employee ID already exists in the database.";
    } else {
        $sql_query = "INSERT INTO admin VALUES ('$name', '$employeeId', '$branchId', '$password')";

        if (mysqli_query($con, $sql_query)) {
            // Append the new admin details to the all-admins.txt file
            $newAdminDetails = $employeeId . "," . $name . "," . $branchId . "\n";
            file_put_contents($filename, $newAdminDetails, FILE_APPEND);

            $message = "Admin added successfully! You will be redirected shortly.";
            header("Refresh: 3; URL=all-admins.php");
            exit;
        } else {
            $message = "Error: " . $sql_query . "<br>" . mysqli_error($con);
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
              
              <div class="form-group">
                  <label for="">Branch</label>
                  <select class="form-control" name="branch_id" required="required">
                  <option value=""> Select Branch</option>
                  <?php
                    $sql = "SELECT * from  branch ";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_assoc($result)){
                      ?>
                      <option value="<?php echo $row['BranchID'];?>"><?php echo $row['Branch Name'];?></option>
                      <?php } ?> 
                  </select>
              </div>
              <label>Password</label>
              <input class="form-control" type="password" name="password" required autocomplete="off"  />
             
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
