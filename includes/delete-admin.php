<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];
    $password = $_POST["password"];

    // Retrieve the password associated with the employee ID from the database
    $query = "SELECT Password FROM admin WHERE EmpID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Since we are working with plaintext passwords (which is not secure),
        // we compare the passwords directly
        if ($password === $row['Password']) {
            // SQL query to delete an admin
            $delete_query = "DELETE FROM admin WHERE EmpID = ?";
            $delete_stmt = $con->prepare($delete_query);
            $delete_stmt->bind_param("s", $employeeId);
            $delete_stmt->execute();

            if ($delete_stmt->affected_rows > 0) {
                $message = "Admin deleted successfully.";


                // Update the all-admins.txt file
                $admins = file('all-admins.txt', FILE_IGNORE_NEW_LINES);
                $newContent = array_filter($admins, function ($line) use ($employeeId) {
                    list($id) = explode(",", $line);
                    return trim($id) !== $employeeId;
                });
                file_put_contents('all-admins.txt', implode("\n", $newContent));

                // Redirect to the all-admins page
                header("Location: all-admins.php");
                exit;
            } else {
                $message = "No admin found with that ID or unable to delete.";
            }

            $delete_stmt->close();
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "No admin found with that ID.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
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
        <h1 class="text-center">Delete Admin</h1>
        <div class="card border-left-danger shadow h-1000 py-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php if (!empty($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="employee_id">Employee ID:</label>
                                <input type="text" id="employee_id" name="employee_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
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
