<?php
    session_start();
    error_reporting(0);
    include('sqlconnect.php');
      $user = $_SESSION['cardno'];
	  
	  //studBooks for bk_name
	  $sql = "SELECT * FROM loan WHERE Cardno = '$user'";
      $result = mysqli_query($con, $sql);	
      
       while ($row = mysqli_fetch_assoc($result)) { 
       	  //addBooks for price and author
       	 $book = $row['BookID'];
	 	 $sql2 = "SELECT * FROM book where BookID = '$book'";
     	 $result2 = mysqli_query($con, $sql2);
	 	 $row2 = mysqli_fetch_assoc($result2);
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
                <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='index.php'){echo 'style-active';}?>"  href="index.php">Logout</a></h4>
                <h4 class="header-line"><a class="default-link-style <?php if($_SERVER["PHP_SELF"]=='dashboard.php'){echo 'style-active';}?>"  href="dashboard.php">Dashboard</a></h4>  
    </div>  
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
               
    </div>
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Borrowed Books 
                        </div>
                        <div class="panel-body">

<div class="col-md-4" style="float:left; height:300px;">   

                                     
<img src="bookimg/<?php echo $row2['bookIMG'];?>" width="100">
                                                <br /><b><?php echo $row2['Title'];?></b><br />
                                                <?php echo "Loan date:" . $row['Loan date'];?><br />
                                                <?php echo "Return date:" . $row['Return date'];?><br />
                                           <?php echo $row['BookID'];?><br />
                                                
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