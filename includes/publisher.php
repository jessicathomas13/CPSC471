<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

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
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='event.php'){echo 'style-active';}?>"  href="admin-event.php">EVENTS</a></h4>
              <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='add-publisher.php'){echo 'style-active';}?>"  href="add-publisher.php">ADD PUBLISHER</a></h4>
              
            </div>

</nav>

<style>

.style-active {
        text-decoration: red underline overline wavy;
}

</style>
<div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">PUBLISHERS</h4>
    </div>
    

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          All Publishers 
                        </div>
                        <div class="panel-body">
                       

<?php  
$sql = "SELECT * FROM publisher";

$result = mysqli_query($con, $sql);

                                
  
while ($row = mysqli_fetch_assoc($result))  {             ?>  
<div class="col-md-4" style="float:left; height:300px;">   

                                     

                                                <br /><b><?php echo $row['Name'];?></b><br />
                                                <?php echo $row['Address'];?><br />
                                                <?php echo $row['Phone'];?><br />
                                            
                                                
                            </div>

                                <?php } ?>  
                      
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>


            
    </div>
    </div>
    </div>

</body>

</html>


