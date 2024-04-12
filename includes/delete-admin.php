<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];

    // Begin transaction to ensure atomicity
    mysqli_begin_transaction($con);

    try {
        // SQL query to delete an admin
        $sql = "DELETE FROM admin WHERE EmpID = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $employeeId);

        // Execute and check if successful
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_affected_rows($con) > 0) {
                $message = "Admin deleted successfully.";

                // Read the contents of the file
                $admins = file('all-admins.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $newContent = array_filter($admins, function ($line) use ($employeeId) {
                    // Check if the line does not contain the employeeId
                    return !str_contains($line, $employeeId);
                });

                // Write the new contents back to the file
                file_put_contents('all-admins.txt', implode("\n", $newContent) . "\n");

                // Commit the transaction
                mysqli_commit($con);

                // Redirect to all-admins page
                header("Location: all-admins.php");
                exit();
            } else {
                throw new Exception("No admin found with that ID.");
            }
        } else {
            throw new Exception("Error deleting admin: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        // An exception has been thrown, rollback the transaction
        mysqli_rollback($con);
        $message = $e->getMessage();
    }
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
        <h1 class="text-center">Delete Admin</h1>
        <div class="card border-left-danger shadow h-1000 py-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="employee_id">Employee ID:</label>
                                <input type="text" id="employee_id" name="employee_id" class="form-control" required>
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