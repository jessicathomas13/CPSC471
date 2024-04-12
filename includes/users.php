<?php
session_start();
include('sqlconnect.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['empid'])) {
    header("Location: login.php");
    exit;
}

$users = [];  // Array to hold user data

// SQL query to fetch user data
$query = "SELECT Cardno, Name FROM user"; // Fetch only Cardno and Name
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all user records
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
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
        .user-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Space below table */
        }
        .user-list th, .user-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .user-list th {
            background-color: #f2f2f2;
        }
        .user-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>User Management</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="edit-user.php">Edit User</a>
        <a href="delete-user.php">Delete User</a>
        <a href="add-user.php">Add User</a>       
    </div>

<div class="content">
    <h2>User List</h2>
    <table class="user-list">
        <tr>
            <th>Card Number</th>
            <th>Name</th>
            <th>Details</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['Cardno']); ?></td>
                <td><?= htmlspecialchars($user['Name']); ?></td>
                <td><a href="user-details.php?cardno=<?= urlencode($user['Cardno']); ?>">user profile</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
