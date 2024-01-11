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
    $queryUser = "SELECT * FROM user WHERE username='$username' ";
    $resultUser = $conn->query($queryUser);

    if ($resultUser->num_rows > 0) {
        $user = $resultUser->fetch_assoc();
        
        // Check if the provided password matches the hashed password in the database
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables and redirect to user dashboard
            $_SESSION['user_id'] = $user['id'];
            $response = array(
                'Message' => 'Login successful!',
                'RedirectURL' => '/librarym/user/index.php',
                'DebugInfo' => array(
                    'ProvidedUsername' => $username,
                    'ProvidedPassword' => $password,
                    'HashedPassword' => $user['password']
                )
            );
            echo json_encode($response);
            exit();
        } else {
            $message = "Error: Incorrect password.";
        }
    } else {
        $message = "Error: User not found.";
    }

    $response = array(
        'Message' => $message,
        'DebugInfo' => array(
            'ProvidedUsername' => $username,
            'ProvidedPassword' => $password
        )
    );
    echo json_encode($response); // You can handle the error message as needed (e.g., display it on the login page)
}
?>
