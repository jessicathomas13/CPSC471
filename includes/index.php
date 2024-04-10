<?php
session_start();
error_reporting(0);
include('sqlconnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $cardno = $_POST['cardno'];
  $password = $_POST['password'];

  if ($cardno != "" && $password != "") {

    $sql_query = "SELECT count(*) AS cntUser FROM user WHERE cardno='" . $cardno . "' and password='" . $password . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if ($count > 0) {
      $_SESSION['cardno'] = $cardno;
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else{
    echo "invalid";
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
<h4 class="header-line">USER LOGIN FORM</h4>
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
<label>Enter Card number</label>
<input class="form-control" type="text" name="cardno" required autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
</div>



<button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="admin-login.php">Admin</a>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->        

</body>

</html>