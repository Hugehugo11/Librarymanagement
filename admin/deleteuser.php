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
    die("Connection failed: " . $conn->connect_error);
}

// Process the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you're receiving the userId from the frontend
    $userId = $_POST["userId"];

    // Perform the delete operation
    $deleteUserQuery = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($deleteUserQuery);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Send a success response to the frontend
        echo json_encode(["success" => true]);
    } else {
        // Send an error response to the frontend
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
