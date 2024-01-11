<?php
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
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // User with the same username or email already exists
        $existingUser = $result->fetch_assoc();
        if ($existingUser['username'] === $username) {
            $message = "Error: Username '$username' already in use.";
        } elseif ($existingUser['email'] === $email) {
            $message = "Error: Email '$email' already in use.";
        }
    } else {
        // Perform the SQL query to insert data with hashed password
        $queryData = "INSERT INTO user (fullname, email, phonenumber, gender, username, password) 
                      VALUES ('$fullname', '$email', '$phonenumber', '$gender', '$username', '$hashedPassword')";

        if ($conn->query($queryData) === TRUE) {
            $message = "Data inserted successfully";
        } else {
            $message = "Error inserting data: " . $conn->error;
        }
    }

    $response[] = array("Message" => $message);
    echo json_encode($response);
}
?>
