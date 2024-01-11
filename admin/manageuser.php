<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Manage Users</title>
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

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

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
    <h2>Manage Users</h2>

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

    // Fetch all users from the database
    $fetchUsersQuery = "SELECT id, username, email FROM user";
    $fetchUsersResult = $conn->query($fetchUsersQuery);

    if ($fetchUsersResult && $fetchUsersResult->num_rows > 0) {
        // Display users in a table
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Username</th>";
        echo "<th>Email</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        while ($row = $fetchUsersResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<button onclick='deleteUser(" . $row["id"] . ")'>Delete</button>";
            //echo "<button onclick='editUser(" . $row["id"] . ")'>Edit</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No users available.";
    }

    if ($fetchUsersResult) {
        $fetchUsersResult->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Footer -->
<div id="footer">
<p>Online Library created by Hugo </p>
</div>

<!-- JavaScript for handling delete and edit actions -->
<script>
    function deleteUser(userId) {
        var confirmDelete = confirm("Are you sure you want to delete this user?");
        if (confirmDelete) {
            // Send an asynchronous request to deleteuser.php with the userId
            fetch('deleteuser.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'userId=' + userId,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("User deleted successfully!");
                    // Reload the page or update the user list as needed
                    location.reload();
                } else {
                    alert("Error deleting user: " + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

   // function editUser(userId) {
        // Redirect or open a modal for editing the user with the specified userId
     //   window.location.href = 'edituser.php?userId=' + userId;
       // alert("Edit user with ID: " + userId);
    //}
</script>

</body>
</html>
