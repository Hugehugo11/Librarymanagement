<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Manage Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            overflow-y: scroll;
        }

        #header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-around;
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
            justify-content: space-around;
            padding: 30px;
        }

        #navigation a {
            text-decoration: none;
            color: #333;
            padding: 8px;
            border-radius: 5px;
            background-color: #fff;
        }

        #main-container {
            text-align: center;
            max-height: 500px; 
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .download-link,
        .action-buttons button {
            display: inline-block;
            margin-top: 5px;
        }

        #footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            
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
    <!-- Navigation links here -->
</div>

<!-- Main Body -->
<div id="main-container">
    <h2>Manage Books</h2>

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

    // Fetch all books from the database
    $fetchBooksQuery = "SELECT id, title, author, description, file_path FROM books";
    $fetchBooksResult = $conn->query($fetchBooksQuery);

    if ($fetchBooksResult && $fetchBooksResult->num_rows > 0) {
        // Display books in a table
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Description</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        while ($row = $fetchBooksResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["author"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<div class='download-link'><a href='" . $row["file_path"] . "' download>Download</a></div>";
            echo "<button onclick='deleteBook(" . $row["id"] . ")'>Delete</button>";
            echo "<button onclick='editBook(" . $row["id"] . ")'>Edit</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No books available.";
    }

    if ($fetchBooksResult) {
        $fetchBooksResult->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Footer -->
<div id="footer">
<p>Online Library created by Hugehugo</p>
</div>

<!-- JavaScript for handling delete and edit actions -->
<script>
    function deleteBook(bookId) {
        var confirmDelete = confirm("Are you sure you want to delete this book?");
        if (confirmDelete) {
            // Send an asynchronous request to deletebook.php with the bookId
            fetch('deletebook.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'bookId=' + bookId,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Book deleted successfully!");
                    // Reload the page or update the book list as needed
                    location.reload();
                } else {
                    alert("Error deleting book: " + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

    function editBook(bookId) {
        // Redirect or open a modal for editing the book with the specified bookId
        window.location.href = 'editbook.php?bookId=' + bookId;
        alert("Edit book with ID: " + bookId);
    }
</script>

</body>
</html>
