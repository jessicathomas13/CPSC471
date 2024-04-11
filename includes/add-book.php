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
  <title> Library </title>
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
    <h1 class="text-center"> Add Book </h1>
    <div class="card  border-left-primary shadow h-1000 py-10" style="box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
-webkit-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 14px 46px -25px rgba(0,0,0,0.75);
border: 0px solid black!important;
      border-radius: 5px;">
      
      <div class="card-body ">
        <div class="row">

          <div class="col-md-6">
            <form action="" method="POST">
            
              <div class="form-group">
                <label for="">Book ID</label>
                <input type="text" name="bookid" class="form-control">
              </div>
             
              <div class="form-group">
                <label for="">Book Name</label>
                <input type="text" name="title" class="form-control ">
              </div>
             
              <div class="form-group">
                <label for="">Genre</label>
                <input type="text" name="genre" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="">Publisher Name</label>
                <select class="form-control" name="publishername" required="required">
                <option value=""> Select Publisher</option>
                <?php
                   $sql = "SELECT * from  publisher ";
                   $result = mysqli_query($con,$sql);
                   while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></option>
                    <?php } ?> 
                </select>
                </div>
                   
               

            
                <div class="form-group">
                <label>Book Image<span style="color:red;">*</span></label>
                <input class="form-control" type="file" name="bookimg" autocomplete="off">
                </div>
                


              <div class="form-group">
                <input type="submit" name="submit" value="Add Book" class="btn btn-primary">
              </div>
            </form>
          
          
          <?php

			if(isset($_POST['submit'])) {
        
        $bkid = $_POST['bookid'];
        $bkname = $_POST['title'];
        $genre = $_POST['genre'];
        $pbname =  $_POST['publishername'] ;
        $filename = $_FILES['bookimg']['name'];
        $name = "bookimg/" .$_FILES['bookimg']['name'];
        $tmp_name = $_FILES['bookimg']['tmp_name'];
        
          
            

        move_uploaded_file($_FILES['bookimg']['tmp_name'], "bookimg/".$filename);
        $sql_query = "insert into book (bookid, genre, title, publishername, bookimg) values('$bkid', '$genre', '$bkname', '$pbname', '$filename')";

        if (mysqli_query($con, $sql_query)) {
                  echo "<script>alert('Book Listed successfully');</script>";
                  echo "<script>window.location.href='admin-dashboard.php'</script>";}
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