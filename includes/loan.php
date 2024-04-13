<?php
session_start();
error_reporting(0);
include('sqlconnect.php');
$user = $_SESSION['cardno'];

// Retrieve books that the user has borrowed
$sql = "SELECT book.*, loan.`Loan date`, loan.`Return date` FROM loan JOIN book ON loan.BookID = book.BookID WHERE loan.Cardno = '$user'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Library Management System - Borrowed Books</title>
  <link rel="stylesheet" href="assets/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome.css">
  <style>
    body {
      padding-top: 20px;
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #403F5D;
      padding: 10px 0;
      text-align: right;
    }
    .navbar a {
      color: white;
      padding: 10px 20px;
      display: inline-block;
      text-decoration: none;
    }
    .navbar a.style-active {
      text-decoration: underline;
    }
    .book-card {
      margin-bottom: 20px;
      padding: 15px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .book-card img {
      width: 100px;
      float: left;
      margin-right: 20px;
    }
    .book-details {
      overflow: hidden; /* Clear float */
    }
    .book-title {
      margin: 0;
      padding-top: 10px; /* Align title vertically */
    }
    .text-muted {
      color: #6c757d!important;
    }
    .panel-body {
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      margin-top: 20px;
    }
    .footer {
      background-color: #403F5D;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <a class="<?php if($_SERVER["PHP_SELF"]=='index.php'){echo 'style-active';}?>" href="index.php">LOGOUT</a>
      <a class="<?php if($_SERVER["PHP_SELF"]=='dashboard.php'){echo 'style-active';}?>" href="dashboard.php">HOME</a>
    </div>
  </nav>

  <div class="container">
    <h2>Borrowed Books</h2>
    <div class="panel-body">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="book-card">
          <img src="bookimg/<?php echo htmlspecialchars($row['bookIMG']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>">
          <div class="book-details">
            <h4 class="book-title"><?php echo htmlspecialchars($row['Title']); ?></h4>
            <p>Loan date: <?php echo htmlspecialchars($row['Loan date']); ?></p>
            <p>Return date: <?php echo htmlspecialchars($row['Return date']); ?></p>
            <p class="text-muted">ID: <?php echo htmlspecialchars($row['BookID']); ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2024 Online Library Database Management System</p>
  </div>

  <!-- Scripts for Bootstrap functionality (Optional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
