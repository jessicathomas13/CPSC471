<?php
session_start();
error_reporting(0);
include('sqlconnect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/font-awesome.css">
    <script>
        function toggleDelete(shouldShow) {
            const checkboxes = document.querySelectorAll('.delete-checkbox');
            const deleteBtn = document.getElementById('delete-btn');
            checkboxes.forEach(cb => cb.style.display = shouldShow ? 'block' : 'none');
            deleteBtn.style.display = shouldShow ? 'block' : 'none';
        }

        function confirmDeletion() {
            const checkedBoxes = document.querySelectorAll('.delete-checkbox:checked');
            return checkedBoxes.length > 0 ? confirm('Are you sure you want to delete the selected events?') : false;
        }
    </script>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding-top: 60px;
      }
      .navbar {
        background-color: #333;
        overflow: hidden;
        position: fixed;
        top: 0;
        width: 100%;
        height: 50px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.4);
      }
      .navbar h4, .navbar a {
        float: right;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
      }
      .navbar h4:hover, .navbar a:hover {
        background-color: #ddd;
        color: black;
      }
      .navbar h1 {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 10px 16px;
        font-size: 24px;
        margin: 0;
      }
      .delete-checkbox, #delete-btn {
            display: none; /* Hide checkboxes and delete button by default */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Events</h1>
        <a href="admin-dashboard.php">Home</a>
        <a href="#" onclick="toggleDelete(true)">Delete Event</a>
        <a href="add-event.php">Add Event</a>
    </nav>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <form method="POST" action="delete-event.php" onsubmit="return confirmDeletion();">
                      <?php
                        $sql = "SELECT * FROM event";
                        $result = mysqli_query($con, $sql);
                        
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-md-4" style="float:left; height:300px;">
                                <b><?php echo $row['EventID'];?></b><br />
                                <?php echo $row['BranchID'];?><br />
                                <?php echo $row['Date'];?><br />
                                <?php echo $row['Description'];?><br />
                                <input type="checkbox" class="delete-checkbox" name="delete_ids[]" value="<?php echo $row['ID']; ?>"><br>
                            </div>
                        <?php } ?>
                        <button type="submit" id="delete-btn" class="btn btn-danger">Delete Selected</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
