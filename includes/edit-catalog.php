<?php
session_start();
error_reporting(E_ALL);
include('sqlconnect.php');

$catalog_id = isset($_GET['catalog_id']) ? $_GET['catalog_id'] : '';
$row = ['BranchID' => '', 'BookID' => '', 'Num_of_copies' => '', 'Book Location' => ''];

// Fetch catalog details based on catalog ID
if ($catalog_id) {
    $sql = "SELECT * FROM catalog WHERE CatalogID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $catalog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                        <label for="branch">Branch:</label>
                        <select id="branch" name="branchid" class="form-control">
                            <option value="">Select Branch</option>
                            <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo $branch['BranchID']; ?>" <?php if ($row['BranchID'] == $branch['BranchID']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($branch['Branch Name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="book">Book:</label>
                        <select id="book" name="bookid" class="form-control">
                            <option value="">Select Book</option>
                            <?php foreach ($books as $book): ?>
                                <option value="<?php echo $book['BookID']; ?>" <?php if ($row['BookID'] == $book['BookID']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($book['Title']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="copies">No. of copies:</label>
                        <input type="number" id="copies" name="copies" class="form-control" value="<?php echo $row['Num_of_copies']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Book Location:</label>
                        <input type="text" id="location" name="location" class="form-control" value="<?php echo $row['Book Location']; ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update Catalog</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
