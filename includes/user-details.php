<?php
session_start();
include('sqlconnect.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['empid'])) {
    header("Location: login.php");
    exit;
}
// Get the card number from the URL
$cardno = isset($_GET['cardno']) ? $_GET['cardno'] : '';

// Prepare to fetch user details
$userQuery = "SELECT Name, Cardno, Address, `Phone no.`, BranchID FROM user WHERE Cardno = ?";
$stmt = $con->prepare($userQuery);
$stmt->bind_param("s", $cardno);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Prepare to fetch loan details
$loanQuery = "SELECT BookID, `BranchID`, `Loan date`, `Return date` FROM loan WHERE Cardno = ?";
$stmt = $con->prepare($loanQuery);
$stmt->bind_param("s", $cardno);
$stmt->execute();
$loanResult = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #efefef;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Details</h1>
    <table>
        <tr><th>Name</th><td><?= htmlspecialchars($user['Name']); ?></td></tr>
        <tr><th>Card Number</th><td><?= htmlspecialchars($user['Cardno']); ?></td></tr>
        <tr><th>Address</th><td><?= htmlspecialchars($user['Address']); ?></td></tr>
        <tr><th>Phone Number</th><td><?= htmlspecialchars($user['Phone no.']); ?></td></tr>
        <tr><th>Branch ID</th><td><?= htmlspecialchars($user['BranchID']); ?></td></tr>
    </table>
    <h2>Loan Details</h2>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Branch ID</th>
            <th>Loan Date</th>
            <th>Return Date</th>
        </tr>
        <?php while ($loan = $loanResult->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($loan['BookID']); ?></td>
            <td><?= htmlspecialchars($loan['BranchID']); ?></td>
            <td><?= htmlspecialchars($loan['Loan date']); ?></td>
            <td><?= htmlspecialchars($loan['Return date']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<!-- Add Loan button -->
<div style="margin-top: 20px;">
        <form action="add-loan.php" method="get">
            <input type="hidden" name="cardno" value="<?= htmlspecialchars($cardno); ?>">
            <input type="submit" value="Add Loan">
        </form>
    </div>

    <!-- Delete Loan button -->
    <div style="margin-top: 20px;">
        <form action="delete-loan.php" method="get">
            <input type="submit" value="Delete Loan">
        </form>
    </div>

</div>


</body>
</html>