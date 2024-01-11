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

// Check if user ID is provided in the URL
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Fetch user details from the database
    $fetchUserQuery = "SELECT id, username, email FROM user WHERE id = ?";
    $stmt = $conn->prepare($fetchUserQuery);

    // Check if the prepare was successful
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $userId);

    // Check if the bind_param was successful
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    $userDetails = $stmt->get_result()->fetch_assoc();

    if (!$userDetails) {
        die("User not found.");
    }

    $stmt->close();
} else {
    die("User ID not provided.");
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            overflow-y: scroll; /* Added to make the page scrollable */
        }

        #header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-around; /* Updated to space between items */
            align-items: center;
            padding: 10px;
        }

        #header img {
            max-width: 140px;
            height: auto;
        }

        #navigation {
            background-color: #ddd;
            display: flex;
            justify-content: space-around; /* Updated to evenly distribute items */
            padding: 30px;
        }

        #navigation a {
            text-decoration: none;
            color: #333;
            padding: 8px;
            border-radius: 5px;
            background-color: #fff; /* Background color added for better visibility */
        }

        #main-container {
            text-align: center;
            padding: 20px;
        }

        #main-container form {
            max-width: 400px;
            margin: 0 auto;
        }

        #main-container label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        #main-container input, #main-container textarea, #main-container button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div id="header">
        <img src="/librarym/assets/img/picture1.png" alt="Library Management System">
        <h1 style="margin: 0;"> Admin Dashboard</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
    </div>

    <div id="main-container">
        <h2>Edit User</h2>
        <form action="edituser.php?userId=<?php echo $userId; ?>" method="post">
            <label for="userId">User ID:</label>
            <input type="text" name="userId" value="<?php echo $userDetails['id']; ?>" readonly>

            <label for="newUsername">New Username:</label>
            <input type="text" name="newUsername" value="<?php echo $userDetails['username']; ?>" required>

            <label for="newEmail">New Email:</label>
            <input type="email" name="newEmail" value="<?php echo $userDetails['email']; ?>" required>

            <!-- Add other form fields as needed -->

            <button type="submit">Update User</button>
        </form>
    </div>

    <!-- Footer -->
    <div id="footer">
    <p>Online Library created by Hugehugo</p>
    </div>

</body>
</html>
