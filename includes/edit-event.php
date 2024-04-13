<?php
session_start();
include('sqlconnect.php');

$eventID = isset($_GET['EventID']) ? $_GET['EventID'] : null;
$eventDetails = null;

// Fetch event details from the database based on the event ID
if ($eventID) {
    $query = "SELECT * FROM event WHERE EventID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    $eventDetails = $result->fetch_assoc();
    $stmt->close();
}

// Redirect if no event is found
if (!$eventDetails) {
    echo "<script>alert('No event found with this ID.'); window.location.href='admin-dashboard.php';</script>";
    exit;
}

// Fetch authors and publishers for dropdown
$branch = mysqli_query($con, "SELECT * FROM branch");


// Handle form submission for updating event details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventname = $_POST['eventname'];
    $branchid= $_POST['branch'];
    $date = $_POST['date'];
    $description = $_POST['description'];


    $updateQuery = "UPDATE event SET EventName=?, BranchID=?, Date=?, Description=? WHERE EventID=?";
    $updateStmt = $con->prepare($updateQuery);
    $updateStmt->bind_param("sssssi", $eventname, $branchid, $date, $description, $eventID);
    $updateStmt->execute();
    $updateStmt->close();

    echo "<script>alert('Event updated successfully.'); window.location.href='admin-event.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Event Details</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>EventName:</label>
                <input type="text" class="form-control" name="eventname" value="<?php echo htmlspecialchars($eventDetails['EventName']); ?>" required>
            </div>
            <div class="form-group">
                                <label for="">Branch ID:</label>
                                <select class="form-control" name="publishername" required="required">
                                    <option value="">Select BranchID</option>
                                    <?php
                                    $sql = "SELECT * FROM branch";
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
            <div class="form-group">
                <label>Date:</label>
                <input type="datetime-local" class="form-control" name="date" value="<?php echo htmlspecialchars($eventDetails['Date']); ?>" required>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($eventDetails['Description']); ?>" required>
            </div>
            
        
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>
</body>
</html>
