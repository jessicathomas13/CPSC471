

<!DOCTYPE html>
<html>
<head>
    <title>Admin Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 60px; /* adjusted to give space for the fixed navbar */
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            height: 50px; /* slimmer navbar */
            box-shadow: 0 2px 4px rgba(0,0,0,0.4); /* subtle shadow for a bit of depth */
        }
        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s; /* smooth transition for hover effect */
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
            font-size: 24px; /* smaller font size */
            margin: 0; /* remove default margin */
        }
        .admin-list {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
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
        <a href="edit-admin.php">Edit Admin</a>
        <a href="delete-admin.php">Delete Admin</a>
        <a href="add-admin.php">Add Admin</a>
    </div>

    <div class="content">
        <?php
        // Read the list of admins from the file
        $admins = file('all-admins.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Display the list of admins
        echo '<h2>Admin List</h2>';
        echo '<table class="admin-list">';
        echo '<tr><th>Employee ID</th><th>Name</th><th>Branch ID</th></tr>';
        foreach ($admins as $admin) {
            list($id, $name, $branch) = explode(',', $admin);
            echo "<tr><td>" . htmlspecialchars($id) . "</td><td>" . htmlspecialchars($name) . "</td><td>" . htmlspecialchars($branch) . "</td></tr>";
        }
        echo '</table>';
        ?>
    </div>

</body>
</html>

