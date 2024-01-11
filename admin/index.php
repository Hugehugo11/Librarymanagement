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
        }

        #header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between; /* Updated to space between items */
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

        #footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


        .dropdown {
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            .dropdown-content a {
                color: #333;
                padding: 8px;
                text-decoration: none;
                display: block;
                border-radius: 5px;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dashboard-info {
                    border: 1px solid #ddd;
                    padding: 15px;
                    margin-bottom: 20px;
                    border-radius: 8px;
                    text-align: center;
                }

                .info-label {
                    margin-bottom: 10px;
                    font-size: 18px;
                }

                .info-number {
                    font-size: 24px;
                    color: #333;
                    font-weight: bold;
                }

            /* Adjusted styling for better appearance */
            #navigation a.dropbtn {
                background-color: #ddd;
                border-radius: 5px;
                padding: 8px;
            }

    </style>
</head>
<body>

    <!-- Header -->
    <div id="header">
        <img src="/librarym/assets/img/picture1.png" alt="Library Management System">
        <h1 style="margin: 0;"> Admin Dashboard</h1>
        <a id="logout-btn" href="adminlogout.php">Log Out</a>
    </div>

    <!-- Navigation -->
    <div id="navigation">
    <a href="#">Dashboard</a>
    <div class="dropdown">
        <a href="#" class="dropbtn">Books</a>
        <div class="dropdown-content">
            <a href="addbook.php">Add Book</a>
            <a href="managebook.php">Manage Books</a>
        </div>
    </div>
    <a href="manageuser.php">Users</a>
</div>

    <!-- Main Body -->
    <div id="main-container">
    <h2>Admin Dashboard</h2>

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

    // Fetch the number of users
    $fetchUsersQuery = "SELECT COUNT(*) AS userCount FROM user";
    $fetchUsersResult = $conn->query($fetchUsersQuery);
    $userCount = ($fetchUsersResult && $fetchUsersResult->num_rows > 0) ? $fetchUsersResult->fetch_assoc()['userCount'] : 0;

    // Fetch the number of books
    $fetchBooksQuery = "SELECT COUNT(*) AS bookCount FROM books";
    $fetchBooksResult = $conn->query($fetchBooksQuery);
    $bookCount = ($fetchBooksResult && $fetchBooksResult->num_rows > 0) ? $fetchBooksResult->fetch_assoc()['bookCount'] : 0;

    echo "<div class='dashboard-info'>";
    echo "<h3 class='info-label'>Number of Users:</h3>";
    echo "<p class='info-number'>$userCount</p>";
    echo "</div>";

    echo "<div class='dashboard-info'>";
    echo "<h3 class='info-label'>Number of Books:</h3>";
    echo "<p class='info-number'>$bookCount</p>";
    echo "</div>";

    // Close the database connection
    $conn->close();
    ?>
</div>


    <!-- Footer -->
    <div id="footer">
    <p>Online Library created by Hugehugo</p>
    </div>


</body>
</html>
