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
    <title>Library</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .lel {
            border: 1px solid black;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <br><br>


    <div class="container">
        <h1 class="text-center">Add Book to Catalog</h1>
        <div class="card border-left-primary shadow h-1000 py-10" style="box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
-webkit-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
border: 0px solid black!important;
            border-radius: 5px;">

            <div class="card-body ">
                <div class="row">

                    <div class="col-md-6">
                        <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                        <label for="">Branch:</label>
                        <select class="form-control" name="branchid" required="required">
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

                        <div class="form-group">
                        <label for="">Book:</label>
                        <select class="form-control" name="bookid" required="required">
                        <option value=""> Select Book</option>
                        <?php
                          $sql = "SELECT * from  book ";
                          $result = mysqli_query($con,$sql);
                          while ($row = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $row['BookID'];?>"><?php echo $row['Title'];?></option>
                            <?php } ?> 
                        </select>
                    </div>

                            <div class="form-group">
                                <label for="">No. of copies:</label>
                                <input type="text" name="copies" class="form-control ">
                            </div>

                            <div class="form-group">
                                <label for="">Book Location:</label>
                                <input type="text" name="location" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Book to Catalog" class="btn btn-primary">
                            </div>
                        </form>

                        <?php

                        if (isset($_POST['submit'])) {

                            $bkid = $_POST['bookid'];
                            $branch = $_POST['branchid'];
                            $copies = $_POST['copies'];
                            $location = $_POST['location'];

                            $sql_query = "insert into catalog (BranchID, BookID, Num_of_copies, Book Location) VALUES ('$branchid', '$bkid', '$copies', '$location')";

                            if (mysqli_query($con, $sql_query)) {
                                      echo "<script>alert('Book added to catalog successfully!');</script>";
                                echo "<script>window.location.href='admin-catalogs.php'</script>";}
                            else {
                                      echo "Error: " . $sql_query . "<br>" . mysqli_error($con);	}
                        
                            
                          } 
                          ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

