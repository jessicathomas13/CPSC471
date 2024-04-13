<?php
session_start();
error_reporting(E_ALL);
include('sqlconnect.php');



// Fetch catalog details based on catalog ID


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catalog_id = $_POST['catalogid'];
    $branchId = $_POST["branchid"];
    $bookId = $_POST["bookid"];
    $copies = $_POST["copies"];
    $location = $_POST["location"];

    // Update catalog
    $sql_query = "UPDATE catalog SET BranchID = ?, BookID = ?, Num_of_copies = ?, `Book Location` = ? WHERE CatalogID = ?";
    $stmt = $con->prepare($sql_query);
    $stmt->bind_param('iiisi', $branchId, $bookId, $copies, $location, $catalog_id);
    if ($stmt->execute()) {
        $message = "Catalog details updated successfully!";
        header("refresh:1; url=admin-catalogs.php");
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all branches and books for the dropdowns
$branches = [];
$branchQuery = "SELECT BranchID, `Branch Name` FROM branch";
$result = mysqli_query($con, $branchQuery);
while ($row_branch = mysqli_fetch_assoc($result)) {
    $branches[] = $row_branch;
}
mysqli_free_result($result);


$books = [];
$bookQuery = "SELECT BookID, Title FROM book";
$result = mysqli_query($con, $bookQuery);
while ($row_book = mysqli_fetch_assoc($result)) {
    $books[] = $row_book;
}
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catalog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 40px;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Catalog Entry</h2>
                <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>
                <form action="" method="POST">
                <div class="form-group">
                                <label for="">Catalog ID</label>
                                <select class="form-control" name="catalogid" required="required">
                                    <option value="">Select Catalog ID</option>
                                    <?php
                                    $sql = "SELECT * FROM catalog";
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row['CatalogID']; ?>"><?php echo $row['CatalogID']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                            <label for="">Branch:</label>
                            <select class="form-control" name="branchid" required="required">
                                <option value="">Select Branch</option>
                                <?php
                                $sql = "SELECT * FROM branch";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['BranchID']; ?>"><?php echo $row['Branch Name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Book:</label>
                            <select class="form-control" name="bookid" required="required">
                                <option value="">Select Book</option>
                                <?php
                                $sql = "SELECT * FROM book";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['BookID']; ?>"><?php echo $row['Title']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <div class="form-group">
                                <label for="">No. of copies</label>
                                <input type="text" name="copies" class="form-control">
                            </div>
                    <div class="form-group">
                                <label for="">Book Location</label>
                                <input type="text" name="location" class="form-control">
                            </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Update Catalog</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
