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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];

    // Check if the book with the same title and author already exists
    $checkBookQuery = "SELECT id FROM books WHERE title = ? AND author = ?";
    $checkBookStmt = $conn->prepare($checkBookQuery);
    
    if ($checkBookStmt) {
        $checkBookStmt->bind_param("ss", $title, $author);
        $checkBookStmt->execute();
        $checkBookStmt->store_result();

        if ($checkBookStmt->num_rows > 0) {
            echo "Error: A book with the same title and author already exists.";
        } else {
            // File upload handling
            $file_path = "uploads/"; // Change this to your desired upload directory

            // Create the uploads directory if it doesn't exist
            if (!file_exists($file_path) && !is_dir($file_path)) {
                mkdir($file_path, 0777, true);
            }

            $file_name = uniqid() . '_' . basename($_FILES["book_file"]["name"]);
            $target_file = $file_path . $file_name;

            if (move_uploaded_file($_FILES["book_file"]["tmp_name"], $target_file)) {
                // Insert data into the database using prepared statements
                $insertQuery = "INSERT INTO books (title, author, description, file_path) VALUES (?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);

                if ($insertStmt) {
                    $insertStmt->bind_param("ssss", $title, $author, $description, $target_file);

                    if ($insertStmt->execute()) {
                        echo "Book added successfully!";
                    } else {
                        echo "Error: " . $insertStmt->error;
                    }

                    $insertStmt->close();
                } else {
                    echo "Error preparing statement for book insertion.";
                }
            } else {
                echo "Error uploading file.";
            }
        }

        $checkBookStmt->close();
    } else {
        echo "Error preparing statement for book check.";
    }
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
            margin:  0;
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

    <!-- Header -->
    <div id="header">
        <img src="/librarym/assets/img/picture1.png" alt="Library Management System">
        <h1 style="margin: 0;"> Admin Dashboard</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
    </div>

    <!-- Main Body -->
    <div id="main-container">
        <h2>Add a New Book</h2>
        <form action="addbook.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" required>

            <label for="author">Author:</label>
            <input type="text" name="author" required>

            <label for="description">Description:</label>
            <textarea name="description"></textarea>

            <label for="book_file">Upload Book (PDF):</label>
            <input type="file" name="book_file" accept=".pdf" required>

            <button type="submit">Add Book</button>
        </form>
    </div>

    <!-- Footer -->
    <div id="footer">
    <p>Online Library created by Hugehugo</p>
    </div>

</body>
</html>
