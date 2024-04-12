<?php
session_start();
include('sqlconnect.php');

// Redirect if not logged in
if (!isset($_SESSION['empid'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Check if the right admin is editing the data
if (isset($_GET['employee_id']) && $_GET['employee_id'] != $_SESSION['empid']) {
    header("Location: all-admins.php");
    exit;
}

$empid = $_SESSION['empid'];  // Fetch admin details for the logged-in user
$name = $branchid = "";

$query = "SELECT * FROM admin WHERE EmpID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $empid);
$stmt->execute();
$result = $stmt->get_result();
if ($admin = $result->fetch_assoc()) {
    $name = $admin['Name'];
    $branchid = $admin['BranchID'];
} else {
    $message = "Admin not found.";
}

// Handle post request to update admin details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empid = $_POST['empid'];
    $name = $_POST['name'];

    if ($empid == $_SESSION['empid']) {
        $updateQuery = "UPDATE admin SET EmpID=?, Name=? WHERE EmpID=?";
        $stmt = $con->prepare($updateQuery);
        $stmt->bind_param("sss", $empid, $name, $_SESSION['empid']);
        if ($stmt->execute()) {
            // Also update the all-admins.txt file
            $lines = file('all-admins.txt');
            foreach ($lines as $key => $line) {
                list($fileEmpId) = explode(',', $line);
                if (trim($fileEmpId) == $_SESSION['empid']) {
                    $lines[$key] = "$empid,$name,$branchid\n";  // Keep the branch ID unchanged
                    break;
                }
            }
            file_put_contents('all-admins.txt', implode("", $lines));
            $message = "Admin updated successfully. You will be redirected shortly";
            echo $message;
            header("Refresh: 2; URL=all-admins.php");
            exit;
            $_SESSION['empid'] = $empid;  // Update the session if the Employee ID changes
        } else {
            $message = "Error updating admin: " . $stmt->error;
        }
    } else {
        $message = "You can only update your own data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
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
    <h1>Edit Admin</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="empid">Employee ID:</label>
            <input type="text" class="form-control" id="empid" name="empid" value="<?php echo htmlspecialchars($empid); ?>" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
