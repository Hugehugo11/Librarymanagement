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

        .download-link {
            display: inline-block;
            margin-top: 5px;
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
        <h1 style="margin: 0;"> Library Management System</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
        <!-- Navigation links here -->
    </div>

    <!-- Main Body -->
<div id="main-container">
    <h2>Available Books</h2>

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
            echo "<button onclick='likeBook(" . $row["id"] . ")' style='margin-right: 5px;'>Like</button>";
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

<!-- JavaScript for handling like and comment actions -->
<script>
    function likeBook(bookId) {
        // Send an asynchronous request to like-book.php with the bookId
        sendInteraction(bookId, 'like');
    }

    function sendInteraction(bookId, actionType) {
        // You can use fetch or AJAX to send a request to the server
        fetch('interactionhandler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'bookId=' + bookId + '&actionType=' + actionType,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(actionType.charAt(0).toUpperCase() + actionType.slice(1) + " successful!");
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>



    <!-- Footer -->
    <div id="footer">
        <p>Online Library created by Hugo </p>
    </div>

</body>
</html>
