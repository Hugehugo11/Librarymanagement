<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "library1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX/fetch request
$bookId = $_POST['bookId'];
$actionType = $_POST['actionType'];

// Perform the required database operations
$query = "INSERT INTO book_interactions (book_id, user_id, action_type) VALUES ($bookId, 1, '$actionType')"; // Replace '1' with the actual user ID
$result = $conn->query($query);

if ($result) {
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'error' => $conn->error];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
