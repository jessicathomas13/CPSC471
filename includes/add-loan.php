<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['empid'])) {
    header("Location: login.php");
    exit;
}

// Initialize the variables
$cardno = isset($_GET['cardno']) ? $_GET['cardno'] : '';
$loanAdded = false; // Initialize the flag
$error_message = ''; // Initialize the error message

// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize POST data and assign variables
    $cardno = $_POST['cardno'];
    $bookID = $_POST['bookID'];
    $branchID = $_POST['branchID'];
    $loanDate = $_POST['loanDate'];
    $returnDate = $_POST['returnDate'];

    // Check if the BookID exists in the book table
    $stmt = $con->prepare("SELECT COUNT(*) FROM book WHERE BookID = ?");
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $stmt->bind_result($bookExists);
    $stmt->fetch();
    $stmt->close();

    if ($bookExists == 0) {
        $error_message = "Book ID does not exist.";
    } else {
        // Check if the book has already been loaned and not returned
        $stmt = $con->prepare("SELECT COUNT(*) FROM loan WHERE BookID = ? AND `Return date` > NOW()");
        $stmt->bind_param("i", $bookID);
        $stmt->execute();
        $stmt->bind_result($loanCount);
        $stmt->fetch();
        $stmt->close();

        if ($loanCount > 0) {
            $error_message = "This book has already been loaned.";
        } else {
            // Proceed with inserting the new loan
            $stmt = $con->prepare("INSERT INTO loan (BookID, Cardno, BranchID, `Loan date`, `Return date`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $bookID, $cardno, $branchID, $loanDate, $returnDate);
            if ($stmt->execute()) {
                $loanAdded = true; // Set the flag to true since the loan was added
            } else {
                $error_message = "Error: " . $stmt->error; // Store any error message
            }
            $stmt->close();
        }
    }
}

// If the loan was added successfully, set a success message
if ($loanAdded) {
    // Use JavaScript for a 2-second delay before redirecting
    echo "<script>alert('Loan added successfully!'); window.setTimeout(function() { window.location.href = 'user-details.php?cardno=" . urlencode($cardno) . "&loanadded=true'; }, 2000);</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Loan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        input[type=text], input[type=datetime-local], input[type=number], input[type=submit] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 48%; /* Responsive inputs */
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            width: auto; /* Auto width for the submit button */
        }
        input[type=submit]:hover {
            opacity: 0.9;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add Loan for Card Number: <?= htmlspecialchars($cardno); ?></h1>
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>
    <form action="add-loan.php" method="post">
        <input type="hidden" name="cardno" value="<?= htmlspecialchars($cardno); ?>">
        <input type="number" name="bookID" placeholder="Book ID" required>
        <input type="number" name="branchID" placeholder="Branch ID" required>
        <input type="datetime-local" name="loanDate" placeholder="Loan Date" required>
        <input type="datetime-local" name="returnDate" placeholder="Return Date" required>
        <input type="submit" value="Add Loan">
    </form>
</div>

</body>
</html>