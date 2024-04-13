<?php
session_start();
include('sqlconnect.php');

$bookID = isset($_GET['bookID']) ? $_GET['bookID'] : null;
$bookDetails = null;

// Fetch book details from the database based on the book ID
if ($bookID) {
    $query = "SELECT * FROM book WHERE BookID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookDetails = $result->fetch_assoc();
    $stmt->close();
}

// Redirect if no book is found
if (!$bookDetails) {
    echo "<script>alert('No book found with this ID.'); window.location.href='admin-dashboard.php';</script>";
    exit;
}

// Fetch authors and publishers for dropdown
$authors = mysqli_query($con, "SELECT * FROM author");
$publishers = mysqli_query($con, "SELECT * FROM publisher");

// Handle form submission for updating book details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publisher = $_POST['publisher'];

    $image = $bookDetails['bookIMG']; // default to old image
    if ($_FILES['image']['name']) { // new image uploaded
        $image = $_FILES['image']['name'];
        $target = "bookimg/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $updateQuery = "UPDATE book SET Title=?, AuthorName=?, Genre=?, PublisherName=?, bookIMG=? WHERE BookID=?";
    $updateStmt = $con->prepare($updateQuery);
    $updateStmt->bind_param("sssssi", $title, $author, $genre, $publisher, $image, $bookID);
    $updateStmt->execute();
    $updateStmt->close();

    echo "<script>alert('Book updated successfully.'); window.location.href='admin-dashboard.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Book Details</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($bookDetails['Title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <select class="form-control" name="author" required>
                    <?php while ($author = mysqli_fetch_assoc($authors)) {
                        echo "<option value='" . htmlspecialchars($author['Name']) . "'" . ($author['Name'] == $bookDetails['AuthorName'] ? ' selected' : '') . ">" . htmlspecialchars($author['Name']) . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Genre:</label>
                <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($bookDetails['Genre']); ?>" required>
            </div>
            <div class="form-group">
                <label>Publisher:</label>
                <select class="form-control" name="publisher" required>
                    <?php while ($publisher = mysqli_fetch_assoc($publishers)) {
                        echo "<option value='" . htmlspecialchars($publisher['Name']) . "'" . ($publisher['Name'] == $bookDetails['PublisherName'] ? ' selected' : '') . ">" . htmlspecialchars($publisher['Name']) . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Book Image:</label>
                <input type="file" class="form-control-file" name="image">
                <small>Current Image: <?php echo htmlspecialchars($bookDetails['bookIMG']); ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>
</body>
</html>
