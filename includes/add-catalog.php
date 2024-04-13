<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catalogid = $_POST["catalog_id"];
    $branchId = $_POST["branch_id"];
    $bookId = $_POST["bookid"];
    $copies = $_POST["copies"];
    $location = $_POST["location"];

    $sql_query = "insert into catalog values('$catalogid', '$branchId', '$bookId', '$copies', '$location')";

    if (mysqli_query($con, $sql_query)) {
              echo "<script>alert('Catlog updated successfully!');</script>";
        echo "<script>window.location.href='admin-catalogs.php'</script>";}
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


<style>

.style-active {
        text-decoration: red underline overline wavy;
} 
</style>
  <div class="container">
    <h1 class="text-center">Add Catalog</h1>
    <div class="card border-left-primary shadow h-1000 py-10">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form action="add-catalog.php" method="POST">
              <div class="form-group">
                <label for="catalog_id">Catalog ID:</label>
                <input type="text" id="catalog_id" name="catalog_id" class="form-control" required>
              
              
              <div class="form-group">
                  <label for="">Branch:</label>
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
                  <label for="">Branch:</label>
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

              <div class="form-group">
              <label>No. of copies:</label>
              <input class="form-control"  name="copies"  />
              </div>
              <div class="form-group">
              <label>Location:</label>
              <input class="form-control"  name="location"  />
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