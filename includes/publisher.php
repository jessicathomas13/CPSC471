<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

$publishers = [];  


$query = "SELECT * FROM publisher"; 
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();


while ($row = $result->fetch_assoc()) {
    $publishers[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Publisher Management</title>
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
        .publisher-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Space below table */
        }
        .publisher-list th, .publisher-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .publisher-list th {
            background-color: #f2f2f2;
        }
        .publisher-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Publisher Management</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="edit-publisher.php">Edit Publisher</a>
        <a href="delete-publisher.php">Delete Publisher</a>
        <a href="add-publisher.php">Add Publisher</a>       
    </div>

<div class="content">
    <h2>Publisher List</h2>
    <table class="publisher-list">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone number</th>
        
        </tr>
        <?php foreach ($publishers as $publisher): ?>
            <tr>
                <td><?= htmlspecialchars($publisher['Name']); ?></td>
                <td><?= htmlspecialchars($publisher['Address']); ?></td>
                <td><?= htmlspecialchars($publisher['Phone']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>