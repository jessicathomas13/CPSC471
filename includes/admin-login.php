<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empid = $_POST['empid'];
    $password = $_POST['password'];

    if ($empid != "" && $password != "") {
        // Use prepared statement to prevent SQL Injection
        $stmt = $con->prepare("SELECT COUNT(*) AS cntAdmin FROM admin WHERE empid=? AND password=?");
        $stmt->bind_param("ss", $empid, $password); // 'ss' specifies the variable types => 'string', 'string'
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();

        $count = $row['cntAdmin'];

        if ($count > 0) {
            $_SESSION['empid'] = $empid;  // Store employee ID in session
            echo "<script type='text/javascript'> document.location = 'admin-dashboard.php'; </script>";
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Please enter both username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Online Library Management System </title>
  <link rel="stylesheet" href="assets/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome.css">
  <style>
    .lel {
      border: 1px solid black;
      border-radius: 5px;
    }
  </style>
</head>

<body>
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">ADMIN LOGIN FORM</h4>
</div>
</div>
 <a name="ulogin"></a>            
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Employee ID </label>
<input class="form-control" type="text" name="empid" required autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
</div>



<button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="index.php">User</a>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->        

</body>

</html>