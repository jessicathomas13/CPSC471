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
  <title>Online Library Management System - Events</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    .flex-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex: 1;
    }
    .navbar-custom {
      background-color: #403F5D;
      color: #fff;
    }
    .navbar-custom .navbar-brand, .navbar-custom .navbar-text, .navbar-custom a {
      color: #fff;
    }
    .card {
      transition: transform .2s;
      cursor: pointer;
      background-color: rgba(255, 255, 255, 0.85);
      color: #403F5D;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card-img-top {
      width: 100%;
      height: 20vw;
      object-fit: cover;
    }
    .footer {
      background-color: #403F5D;
      color: white;
      text-align: center;
      padding: 1px;
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
    }
    body {
      background-image: url('bookimg/bgpic.jpg');
      background-size: cover;
      color: #fff;
      background-position: center;
      background-attachment: fixed;
      backdrop-filter: blur(7px);
    }
    .dashboard-title {
      color: #fff;
      font-weight: bold;
      text-align: center;
      z-index: 999;
    }
  </style>
</head>
<body>
  <div class="flex-wrapper">
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="#">Library System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="add-event.php">ADD EVENT</a></li>
           
            <li class="nav-item"><a class="nav-link" href="delete-event.php">DELETE EVENT</a></li>
            <li class="nav-item"><a class="nav-link" href="admin-dashboard.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link" href="admin-login.php">LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="content">
      <div class="container mt-4">
        <h1 class="text-center mb-4 dashboard-title">Events</h1>
        <div class="row">
          <?php
          $sql = "SELECT event.*, branch.`Branch Name` FROM event JOIN branch ON branch.BranchID = event.BranchID";
          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
              <div class="card book-card h-100" onclick="window.location.href='admin-about-event.php?EventID=<?php echo $row['EventID']; ?>'">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['EventName']); ?></h5>
                  <p class="card-text">Branch: <?php echo htmlspecialchars($row['Branch Name']); ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="footer">
      <p>&copy; 2024 Online Library Database Management System</p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
