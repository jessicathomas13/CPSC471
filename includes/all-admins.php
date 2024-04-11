<!DOCTYPE html>
<html>
<head>
    <title>Admin Management</title>
</head>
<body>
    <h1>Admin Management</h1>

    <?php
    // Read the list of admins from the file
    $admins = file('all-admins.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Display the list of admins
    echo '<h2>Admin List</h2>';
    echo '<ul>';
    foreach ($admins as $admin) {
        echo '<li>' . htmlspecialchars($admin) . '</li>';
    }
    echo '</ul>';
    ?>

    <h2>Options</h2>
    <ul>
        <li><a href="add-admin.php">Add Admin</a></li>
        <li><a href="delete-admin.php">Delete Admin</a></li>
        <li><a href="edit-admin.php">Edit Admin</a></li>
    </ul>
</body>
</html>
