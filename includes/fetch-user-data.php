<?php
include('sqlconnect.php');

// Check if card number is provided in the GET request
if (isset($_GET['cardno'])) {
    $cardno = $_GET['cardno'];

    // Fetch user data for the specified card number
    $query = "SELECT Name, Address, `Phone no.`, EmailID FROM user WHERE Cardno = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $cardno);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user data is found
    if ($user = $result->fetch_assoc()) {
        // Return user data as JSON response
        echo json_encode($user);
    } else {
        // If no user data found, return error message
        echo json_encode(array("error" => "User not found."));
    }
    $stmt->close();
}
?>
