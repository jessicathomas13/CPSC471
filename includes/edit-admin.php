<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = "";
$admins = [];

// Check if the user is logged in
if (!isset($_SESSION['empid'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Fetch all admin data for listing
$sql = "SELECT * FROM admin";
$result = mysqli_query($con, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $admins[] = $row;
    }
} else {
    $message = "Error fetching records: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Admins</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="text-center">List of Admins</h1>
    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif; ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Branch ID</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($admins as $admin): ?>
          <tr>
            <td><?php echo htmlspecialchars($admin['EmpID']); ?></td>
            <td><?php echo htmlspecialchars($admin['Name']); ?></td>
            <td><?php echo htmlspecialchars($admin['BranchID']); ?></td>
            <td>
              <?php if ($_SESSION['empid'] == $admin['EmpID']): ?>
                <a href="edit-admin.php?employee_id=<?php echo htmlspecialchars($admin['EmpID']); ?>" class="btn btn-primary">Edit</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
