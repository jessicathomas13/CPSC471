<?php
include('sqlconnect.php');

$message = "";
$name = ""; 
$nationality = "";

// Handle post request to update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $new_nationality = $_POST['nationality'];
    

    // Prepare the update query
    $updateQuery = "UPDATE author SET Nationality=? WHERE Name=?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("ss", $new_nationality, $name);
    
    $stmt->execute();
    
    // Check if any rows were updated
    if ($stmt->affected_rows > 0) {
        $message = "Author Information Updated Successfully. You will be redirected shortly.";
        echo $message;
        header("Refresh: 2; URL=author.php");
        exit;
    } elseif ($stmt->affected_rows == 0) {
        $message = "Author does not exist.";
    } else {
        $message = "Error updating author: " . $stmt->error;
    }
    $stmt->close();
}

// Check if the card number is set in the URL as a GET parameter
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    // Fetch user details for the specified card number
    $query = "SELECT * FROM author WHERE Name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $name = $user['Name'];
        $address = $user['Nationality'];
        
    } else {
        $message = "Author not found.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Author</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
       
        <div class="form-group">
                <label for="">Author</label>
                <select class="form-control" name="name" required="required">
                <option value=""> Select Author</option>
                <?php
                   $sql = "SELECT * from  author ";
                   $result = mysqli_query($con,$sql);
                   while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></option>
                    <?php } ?> 
                </select>
                </div>
        <div class="form-group">
            <label for="name">Edit Nationality: </label>
            <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
