<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

$catalogs = [];  


$query = "SELECT * FROM catalog"; 
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();


while ($row = $result->fetch_assoc()) {
    $catalogs[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Catalog Management</title>
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
        .catalog-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Space below table */
        }
        .cata-list th, .catalog-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .catalog-list th {
            background-color: #f2f2f2;
        }
        .publisher-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Catalog Management</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="edit-publisher.php">Edit Catalog</a>
        <a href="delete-publisher.php">Delete Catalog</a>
        <a href="add-publisher.php">Add Catalog</a>       
    </div>

<div class="content">
    <h2>Catalog List</h2>
    <table class="catalog-list">
        <tr>
            <th>Catalog Name</th>
            
        
        </tr>
        <?php foreach ($catalogs as $catalog): ?>
            <tr>
                <td><?= htmlspecialchars($catalog['Catalog Name']); ?></td>
                
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>