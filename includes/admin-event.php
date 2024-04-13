<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

$publishers = [];  


$query = "SELECT * FROM event"; 
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();


while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
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
        .event-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Space below table */
        }
        .event-list th, .event-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .event-list th {
            background-color: #f2f2f2;
        }
        .event-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Event Management</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="edit-event.php">Edit Event</a>
        <a href="delete-event.php">Delete Event</a>
        <a href="add-event.php">Add Event</a>       
    </div>

<div class="content">
    <h2>Event List</h2>
    <table class="event-list">
        <tr>
            <th>Event ID</th>
            <th>Branch ID</th>
            <th>Date</th>
            <th>Description</th>
        
        </tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= htmlspecialchars($event['EventID']); ?></td>
                <td><?= htmlspecialchars($event['BranchID']); ?></td>
                <td><?= htmlspecialchars($event['Date']); ?></td>
                <td><?= htmlspecialchars($event['Description']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>