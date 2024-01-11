
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
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
            justify-content: flex-end;
            padding: 10px;
        }

        #navigation a {
            margin: 0 20px;
            text-decoration: none;
            color: #333;
        }

        #main-container {
            text-align: center;
            padding: 20px;
        }

        #login-form-container {
            display: inline-block;
            text-align: left;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Adjust the width as needed */
            margin: 0 auto; /* Center the form horizontally */
        }

        #login-form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        #login-form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        #login-form-container button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 400px;
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
        <img src="assets/img/picture1.png" alt="Library Management System">
        <h1 style="margin: 0;">Library Management System</h1>
    </div>

    <!-- Navigation -->
    <div id="navigation">
        <a href="adminlogin.php">Admin Login</a>
        <a href="usersignup.php">User Signup</a>
        <a href="index.php">User Login</a>
    </div>

    <!-- Main Body -->
    <div id="main-container">
        <div id="login-form-container">
            <h2>User Login Form</h2>
            <form id="login-form" action="userlogin.php" method="post">
                <label for="username">Enter your Username:</label>
                <input type="text" id="username" name="username" autocomplete="off" required><br>

                <label for="password">Enter your Password:</label>
                <input type="password" id="password" name="password" autocomplete="off" required><br>

                <button type="button" onclick="submitLoginForm()">Log In</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
    <p>Online Library created by Hugo </p>
    </div>


    <!-- Include Axios library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function submitLoginForm() {
        const form = document.getElementById('login-form');
        const formData = new FormData(form);

        // Use Axios to post form data to the userlogin.php file
        axios.post('/librarym/includes/userlogin.php', formData)
            .then(response => {
                // Check if the 'Message' property exists in the response data
                if (response.data && response.data.Message) {
                    // Handle successful response
                    alert(response.data.Message);

                    // Redirect user if login is successful
                    if (response.data.RedirectURL) {
                        window.location.href = response.data.RedirectURL;
                    }
                } else {
                    // Handle case where 'Message' property is undefined
                    alert('Login failed. Please try again.');
                }
            })
            .catch(error => {
                // Handle error response
                alert('Login failed. Please try again.');
                console.error(error);
            });
     }
    </script>



</body>
</html>
