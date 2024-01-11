<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select database
$db = mysqli_select_db($conn, "library1");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables using form data
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Check if username exists
    $queryAdmin = "SELECT * FROM admin WHERE username='$username'";
    $resultAdmin = $conn->query($queryAdmin);

    if ($resultAdmin->num_rows > 0) {
        $admin = $resultAdmin->fetch_assoc();
        
        // Check if the provided password matches the hashed password in the database
        if ($password == $admin['password']) {
            // Password is correct, set session variables and redirect to user dashboard
            $_SESSION['admin_id'] = $admin['id'];
            $response = array(
                'Message' => 'Login successful!',
                'RedirectURL' => '/librarym/admin/index.php',
                'Success' => true
            );
            echo json_encode($response);
            exit();
        } else {
            $message = "Error: Incorrect password.";
        }
    } else {
        $message = "Error: Admin not found.";
    }

    $response = array(
        'Message' => $message,
        'Success' => false
    );
    echo json_encode($response); // You can handle the error message on the login page
}
?>
