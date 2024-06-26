<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php'); // Ensure this file has the correct database connection setup.

$message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $publisher = $_POST["publisher"];
    $sql = "SELECT * FROM publisher WHERE Name = ?";
    $checkStmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($checkStmt, "s", $publisher);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
    
    if (mysqli_stmt_num_rows($checkStmt) > 0) {
            // Admin exists, proceed with deletion
            // SQL query to delete a publisher
            $deleteSql = "DELETE FROM publisher WHERE Name = ?";
            $deleteStmt = mysqli_prepare($con, $deleteSql);
            mysqli_stmt_bind_param($deleteStmt, "s", $publisher);
            
            if (mysqli_stmt_execute($deleteStmt)) {
                echo "<script>alert('Publisher deleted successfully!');</script>";
                echo "<script>window.location.href='publisher.php'</script>";
                
            } else {
                    $message = "Error deleting publisher: " . mysqli_stmt_error($deleteStmt);
            }
            
            mysqli_stmt_close($deleteStmt);
    } else {
            $message = "Publisher does not exist!";
    }
    
    mysqli_stmt_close($checkStmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Publisher</title>
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
    <h1 class="text-center">Delete Publisher</h1>
    <div class="card border-left-danger shadow h-1000 py-10">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <select class="form-control" name="publisher" required="required">
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
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
