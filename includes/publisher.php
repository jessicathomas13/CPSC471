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
    <title>Publisher Management</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/font-awesome.css">
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding-top: 60px;
      }
      .navbar {
        background-color: #333;
        overflow: hidden;
        position: fixed;
        top: 0;
        width: 100%;
        height: 50px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.4);
      }
      .navbar h4, .navbar a {
        float: right;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
      }
      .navbar h4:hover, .navbar a:hover {
        background-color: #ddd;
        color: black;
      }
      .navbar h1 {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 10px 16px;
        font-size: 24px;
        margin: 0;
      }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Publishers</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="add-publisher.php">Add Publisher</a>
    </nav>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <!-- Publishers List Start -->
                    <?php  
                    $sql = "SELECT * FROM publisher";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)) { ?>  
                        <div class="col-md-4" style="float:left; height:300px;">   
                            <b><?php echo $row['Name'];?></b><br />
                            <?php echo $row['Address'];?><br />
                            <?php echo $row['Phone'];?><br />
                        </div>
                    <?php } ?>  
                    <!-- Publishers List End -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
