<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin:  0;
            padding: 0;
            background-color: #f4f4f4;
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

        #logout-btn {
            text-decoration: none;
            color: #fff;
            padding: 8px 16px; /* Adjusted padding for better appearance */
            border-radius: 5px;
            background-color: #333; /* Background color adjusted */
            transition: background-color 0.3s; /* Added transition for hover effect */
        }

        #logout-btn:hover {
            background-color: #555; /* Hover background color */
        }

        #navigation {
            background-color: #ddd;
            display: flex;
            justify-content: space-around; /* Updated to evenly distribute items */
            padding: 10px;
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

        #main-container h2 {
            color: #333;
            margin-bottom: 20px;
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
        <h1 style="margin: 0;"> User Dashboard</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
        <a href="#">Dashboard</a>
        <a href="books.php">Books</a>
    </div>

    <!-- Main Body -->
    <div id="main-container">
        <h2> Most Liked Books</h2>

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

        // Replace '1' with the actual user ID
        $userId = 1; // Assuming a simplified scenario, replace with the dynamic user ID

        // Fetch unique liked books and count of likes
        $fetchLikedBooksQuery = "SELECT b.id, b.title, b.author, b.description, b.file_path, COUNT(bi.id) AS like_count
                                FROM books b
                                JOIN book_interactions bi ON b.id = bi.book_id
                                WHERE bi.user_id = $userId
                                AND bi.action_type = 'like'
                                GROUP BY b.id, b.title, b.author, b.description, b.file_path";
        $fetchLikedBooksResult = $conn->query($fetchLikedBooksQuery);

        if ($fetchLikedBooksResult && $fetchLikedBooksResult->num_rows > 0) {
            // Display liked books in a table
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Description</th>";
            //echo "<th>File Path</th>";
            echo "<th>Likes</th>";
            echo "</tr>";

            while ($row = $fetchLikedBooksResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                //echo "<td>" . $row["file_path"] . "</td>";
                echo "<td>" . $row["like_count"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "You haven't liked any books yet.";
        }

        if ($fetchLikedBooksResult) {
            $fetchLikedBooksResult->close();
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <div id="footer">
        <p>Online Library created by Hugehugo </p>
    </div>

</body>
</html>
