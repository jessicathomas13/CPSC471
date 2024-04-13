<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('sqlconnect.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $nationality = trim($_POST["nationality"]);
    
    $sql_query = "INSERT INTO author (Name, Nationality) VALUES (?, ?)";
    $stmt = $con->prepare($sql_query);
    $stmt->bind_param("ss", $name, $nationality);

    if ($stmt->execute()) {
        $message = "Author added successfully!";
        $stmt->close();
        echo "<script>alert('Author added successfully!');</script>";
        echo "<script>window.location.href='author.php'</script>";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Author</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card {
            box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
            -webkit-box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 1px 14px 46px -25px rgba(0, 0, 0, 0.75);
            border: none!important;
            border-radius: 5px;
        }
        .container {
            padding-top: 50px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Add Author</h1>
        <div class="card border-left-primary shadow h-1000 py-10">
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>
                <form action="add-author.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="nationality">Nationality:</label>
                        <input type="text" name="nationality" class="form-control" id="nationality" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
