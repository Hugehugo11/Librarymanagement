<?php
// Assuming your MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "library1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Process DELETE request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookId = mysqli_real_escape_string($conn, $_POST["bookId"]);

    // Delete the book from the database
    $deleteQuery = "DELETE FROM books WHERE id = '$bookId'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error deleting book: ' . $conn->error]);
    }
}

// Close the database connection
$conn->close();
?>
