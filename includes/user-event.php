<?php
session_start();
include('sqlconnect.php');

$event = isset($_GET['EventName']) ? $_GET['EventName'] : null;
$eventDetails = null;

if ($bookID) {
    $query = "SELECT event.*, branch.`Branch Name`, branch.`Address` FROM branch JOIN event ON branch.BranchID = event.BranchID ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $event);
    $stmt->execute();
    $result = $stmt->get_result();
    $eventDetails = $result->fetch_assoc();
    $stmt->close();
}

if (!$eventDetails) {
    echo "<script>alert('No event found with this Name.'); window.location.href='dashboard.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
            height: 100vh; /* Ensure the body takes up the full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('bookimg/bgpic.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(7px); /* Apply blur effect to the background */
            z-index: -1; /* Ensure the background is behind other content */
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.7); /* Black overlay with opacity */
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            color: white; /* Text color */
        }
        .edit-details-title {
            font-weight: bold; /* Make the text bold */
            color: white; /* Text color */
            margin-bottom: 20px; /* Add some space below the title */
        }
        .book-details {
            font-size: 20px;
            color: white;
            margin-bottom: 20px;
        }
        .edit-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="overlay">
        <h1 class="edit-details-title">About The Event</h1>
        <div class="book-details">
            <?php echo htmlspecialchars($eventDetails['EventName']); ?></p>
            <p><strong>Branch:</strong> <?php echo htmlspecialchars($eventDetails['Branch Name']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($bookDetails['Address']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($eventDetails['Description']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($bookDetails['Date']); ?></p>
        </div>

        <a href="dashboard.php" class="btn btn-primary edit-button">Return to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>


