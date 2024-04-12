<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
   

    $sql_query = "insert into publisher values('$name', '$address', '$phone')";

    if (mysqli_query($con, $sql_query)) {
        echo "<script>alert('Publisher added successfully!');</script>";
        echo "<script>window.location.href='publisher.php'</script>";}
    else {
              echo "Error: " . $sql_query . "<br>" . mysqli_error($con);	}

    
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
<nav class="navbar">

<?php // var_dump($_SERVER["PHP_SELF"]);  ?>  <!-- this will show your url -->
<div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-30">
              <div style = "text-align: right">
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='add-book.php'){echo 'style-active';}?>"  href="add-book.php">Add Book</a></h4> 
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='delete-book.php'){echo 'style-active';}?>"  href="delete-book.php">Delete Book</a></h4>
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='admin-login.php'){echo 'style-active';}?>"  href="admin-login.php">Logout</a></h4>
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='all-admins.php'){echo 'style-active';}?>"  href="all-admins.php">OUR ADMINS</a></h4>
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='event.php'){echo 'style-active';}?>"  href="add-event.php">EVENTS</a></h4>
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='publisher.php'){echo 'style-active';}?>"  href="publisher.php">PUBLISHERS</a></h4>
            </div>

</nav>

<style>

.style-active {
        text-decoration: red underline overline wavy;
} 
</style>
  <div class="container">
    <h1 class="text-center">Add Publisher</h1>
    <div class="card border-left-primary shadow h-1000 py-10">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form action="add-publisher.php" method="POST">
              <div class="form-group">
                <label for="event_id">Name:</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              
              
              <div class="form-group">
              <label>Address</label>
              <input class="form-control"  name="address"  />
              </div>
              <div class="form-group">
              <label>Phone</label>
              <input class="form-control"  name="phone"  />
              </div>
             
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
