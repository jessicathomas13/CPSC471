<?php
include('sqlconnect.php');

$message = "";
$cardno = ""; 
$name = $address = $phone_number = "";

// Handle post request to update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cardno = $_POST['cardno'];
    $new_name = $_POST['name'];
    $new_address = $_POST['address'];
    $new_phone_number = $_POST['phone_number'];
    $new_email = $_POST['email'];

    // Prepare the update query
    $updateQuery = "UPDATE user SET Name=?, Address=?, `Phone no.`=?, EmailID=? WHERE Cardno=?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("sssss", $new_name, $new_address, $new_phone_number, $new_email, $cardno);
    
    $stmt->execute();
    
    // Check if any rows were updated
    if ($stmt->affected_rows > 0) {
        $message = "User Information Updated Successfully. You will be redirected shortly.";
        echo $message;
        header("Refresh: 2; URL=users.php");
        exit;
    } elseif ($stmt->affected_rows == 0) {
        $message = "Card number does not exist.";
    } else {
        $message = "Error updating user: " . $stmt->error;
    }
    $stmt->close();
}

// Check if the card number is set in the URL as a GET parameter
if (isset($_GET['cardno'])) {
    $cardno = $_GET['cardno'];

    // Fetch user details for the specified card number
    $query = "SELECT Name, Address, `Phone no.`, EmailID FROM user WHERE Cardno = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $cardno);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $name = $user['Name'];
        $address = $user['Address'];
        $phone_number = $user['Phone no.'];
        $email = $user['EmailID'];
    } else {
        $message = "User not found.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit User</h1>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="cardno">Card Number:</label>
            <!-- Dropdown to select card number -->
            <select class="form-control" id="cardno" name="cardno" onchange="fetchUserData(this.value)" required>
                <option value="">Select Card Number</option>
                <?php
                $query = "SELECT DISTINCT Cardno FROM user";
                $result = $con->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['Cardno']."'>".$row['Cardno']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function fetchUserData(cardno) {
        // AJAX request to fetch user data based on card number
        if (cardno !== "") {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var userData = JSON.parse(this.responseText);
                    if (userData.error) {
                        alert(userData.error); // Display error message if any
                    } else {
                        document.getElementById("name").value = userData.Name;
                        document.getElementById("address").value = userData.Address;
                        document.getElementById("phone_number").value = userData['Phone no.'];
                        document.getElementById("email").value = userData.EmailID;
                    }
                }
            };
            xhttp.open("GET", "fetch-user-data.php?cardno=" + cardno, true);
            xhttp.send();
        }
    }
</script>

</body>
</html>
