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

// Get book ID from the URL
if (isset($_GET['bookId'])) {
    $bookId = mysqli_real_escape_string($conn, $_GET['bookId']);

    // Fetch book details based on the ID
    $fetchBookQuery = "SELECT id, title, author, description FROM books WHERE id = '$bookId'";
    $fetchBookResult = $conn->query($fetchBookQuery);

    if ($fetchBookResult && $fetchBookResult->num_rows > 0) {
        $bookDetails = $fetchBookResult->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Book ID not provided.";
    exit();
}

// Process form data for updating the book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedTitle = mysqli_real_escape_string($conn, $_POST["title"]);
    $updatedAuthor = mysqli_real_escape_string($conn, $_POST["author"]);
    $updatedDescription = mysqli_real_escape_string($conn, $_POST["description"]);

    // Update the book details in the database
    $updateQuery = "UPDATE books SET title = '$updatedTitle', author = '$updatedAuthor', description = '$updatedDescription' WHERE id = '$bookId'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Book updated successfully!";
        // Redirect back to the manage books page after update
        header("Location: managebook.php");
        exit();
    } else {
        echo "Error updating book: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
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

    <div id="header">
        <img src="/librarym/assets/img/picture1.png" alt="Library Management System">
        <h1 style="margin: 0;"> Admin Dashboard</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
    </div>

    <div id="main-container">
        <h2>Edit Book</h2>
        <form action="editbook.php?bookId=<?php echo $bookId; ?>" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $bookDetails['title']; ?>" required>

        <label for="author">Author:</label>
        <input type="text" name="author" value="<?php echo $bookDetails['author']; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $bookDetails['description']; ?></textarea>

            <!-- Add other form fields as needed -->

            <button type="submit">Update Book</button>
    </form>
    </div>

    <!-- Footer -->
    <div id="footer">
    <p>Online Library created by Hugehugo</p>
    </div>

</body>
</html>
