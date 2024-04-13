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
  <title>Online Library Management System - Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
  .navbar-custom {
    background-color: #6d7fcc;
  }

  .navbar-custom .navbar-brand,
  .navbar-custom .navbar-text,
  .navbar-custom a {
    color: #fff;
  }

  .card-img-top {
    width: 100%;
    height: 20vw;
    object-fit: cover;
  }

  .book-card {
    transition: transform .2s;
  }

  .book-card:hover {
    transform: scale(1.05);
  }

  .footer {
    background-color: #6d7fcc;
    color: white;
    text-align: center;
    padding: 1px; /* Adjust this value to make the footer thinner */
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    font-size: medium;
  }
  
  .card-body {
    padding: 4px; /* Adjust this value to reduce space between lines */
  }
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand" href="#">Library System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="add-book.php">Add Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="delete-book.php">Delete Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-login.php">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="all-admins.php">OUR ADMINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">OUR USERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-event.php">EVENTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publisher.php">PUBLISHERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="author.php">AUTHORS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-catalogs.php">CATALOGS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h1 class="text-center mb-4">Dashboard</h1>
  <div class="row">
    <?php
    $sql = "SELECT * FROM book";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4 mb-4">
        <div class="card book-card h-100">
          <img src="bookimg/<?php echo htmlspecialchars($row['bookIMG']); ?>" class="card-img-top" alt="Book Image">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($row['Title']); ?></h5>
            <p class="card-text">Author: <?php echo htmlspecialchars($row['AuthorName']); ?></p>
            <p class="card-text">Genre: <?php echo htmlspecialchars($row['Genre']); ?></p>
            <p class="card-text">Publisher: <?php echo htmlspecialchars($row['PublisherName']); ?></p>
            <p class="card-text">ID: <?php echo htmlspecialchars($row['BookID']); ?></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div class="footer">
  <p>&copy; 2024 Online Library Database Management System</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
