<?php
session_start();
include('sqlconnect.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['empid'])) {
    header("Location: login.php");
    exit;
}

$users = [];  // Array to hold user data

// SQL query to fetch all user data
$query = "SELECT * FROM admin"; // Modify with your actual table columns
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all user records
while ($row = $result->fetch_assoc()) {
    $admins[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 60px; /* Space for the fixed navbar */
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            height: 50px; /* Slim navbar height */
            box-shadow: 0 2px 4px rgba(0,0,0,0.4); /* Shadow for depth */
        }
        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s; /* Transition for hover effect */
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar h1 {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 10px 16px;
            font-size: 24px; /* Font size for title */
            margin: 0; /* Remove default margin */
        }
        .admin-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Space below table */
        }
        .admin-list th, .admin-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .admin-list th {
            background-color: #f2f2f2;
        }
        .admin-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Admin Management</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="edit-admin.php">Edit Admin</a>
        <a href="delete-admin.php">Delete Admin</a>
        <a href="add-admin.php">Add Admin</a>       
    </div>

<div class="content">
    <h2>Admin List</h2>
    <table class="admin-list">
        <tr>
            <th>Name</th>
            <th>Employee ID</th>
            <th>Branch ID</th>
        
        </tr>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= htmlspecialchars($admin['Name']); ?></td>
                <td><?= htmlspecialchars($admin['EmpID']); ?></td>
                <td><?= htmlspecialchars($admin['BranchID']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>