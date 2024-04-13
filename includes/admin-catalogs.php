
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
      background-color: #403F5D;
      color: #fff;
    }
    .navbar-custom .navbar-brand, .navbar-custom .navbar-text, .navbar-custom a {
      color: #fff;
    }
    .card-img-top {
      width: 100%;
      height: 20vw;
      object-fit: cover;
    }
    .book-card {
      transition: transform .2s;
      cursor: pointer;
    }
    .book-card:hover {
      transform: scale(1.05);
    }
    
    .footer {
      background-color: #403F5D;
      color: white;
      text-align: center;
      padding: 1px;
      position: fixed;
      left: 0;
      bottom: 80;
      width: 100%;
    }
    body {
      background-image: url('bookimg/bgpic.jpg');
      background-size: cover;
      color: #fff;
      background-position: center;
      background-attachment: fixed;
      /* Apply the blur effect to the background */
      backdrop-filter: blur(7px);
    }
    /* Add a content container to prevent all content from being blurred */
    .content-container {
      backdrop-filter: none; /* Ensure no blur effect on the content */
    }
    .dashboard-title {
      color: #fff;
      font-weight: bold;
      text-align: center;
      z-index: 999; /* Ensure the title is above other elements */
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
      <li class="nav-item"><a class="nav-link" href="add-catalog.php">ADD BOOK TO CATALOG</a></li>
        <li class="nav-item"><a class="nav-link" href="delete-book.php">DELETE BOOK</a></li>
        <li class="nav-item"><a class="nav-link" href="edit-catalog.php">EDIT CATALOG</a></li>
        <li class="nav-item"><a class="nav-link" href="admin-dashboard.php">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="admin-login.php">LOGOUT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h1 class="text-center mb-4 dashboard-title">Catalog</h1>
  <div class="row">
    <?php
   
    $sql = "SELECT * FROM catalog LEFT JOIN branch ON branch.BranchID = catalog.BranchID LEFT JOIN book ON book.bookID = catalog.bookID";
    $result = mysqli_query($con, $sql);
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4 mb-4">
          
          <div class="card-body">
            <img src="bookimg/<?php echo htmlspecialchars($row['bookIMG']); ?>" class="card-img-top" alt="Book Image">
            <h5 class="card-title"><?php echo htmlspecialchars($row['Title']); ?></h5>
            <p class="card-text">Branch: <?php echo htmlspecialchars($row['Branch Name']); ?></p>
            <p class="card-text">No. of copies: <?php echo htmlspecialchars($row['Num_of_copies']); ?></p>
            <p class="card-text">Book Location: <?php echo htmlspecialchars($row['Book Location']); ?></p>
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

