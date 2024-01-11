<?php
// Include the insert.php file to handle form submission
include('includes/insert.php');

// Redirect to login page after successful signup
if (isset($message) && strpos($message, 'Data inserted successfully') !== false) {
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
}
?>

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

        #signup-form-container {
            display: inline-block;
            text-align: left;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Adjust the width as needed */
            margin: 0 auto; /* Center the form horizontally */
        }

        #signup-form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        #signup-form-container input,
        #signup-form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        #signup-form-container button {
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
    <div id="signup-form-container">
        <h2>User Sign Up Form</h2>
        <form id="signup-form" action="index.php" method="post">
            <label for="fullname">Enter your Full name:</label>
            <input type="text" id="fullname" name="fullname" autocomplete="off" required><br>

            <label for="email">Enter your Email:</label>
            <input type="email" id="email" name="email" autocomplete="off" required><br>

            <label for="phonenumber">Enter your Phone number:</label>
            <input type="text" id="phonenumber" name="phonenumber" autocomplete="off" required><br>

            <label for="gender">Enter your Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>

            <label for="username">Enter your Username:</label>
            <input type="text" id="username" name="username" autocomplete="off" required><br>

            <label for="password">Enter your Password:</label>
            <input type="password" id="password" name="password"  autocomplete="off" required><br>

            <button type="button" onclick="submitForm()">Sign Up</button>
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
    function submitForm() {
        const form = document.getElementById('signup-form');

        // Validate form fields
        const fullname = form.elements['fullname'].value;
        const email = form.elements['email'].value;
        const phonenumber = form.elements['phonenumber'].value;
        const gender = form.elements['gender'].value;
        const username = form.elements['username'].value;
        const password = form.elements['password'].value;

        // Check if any required field is empty
        if (!fullname || !email || !phonenumber || !gender || !username || !password) {
            alert('Please fill in all fields.');
            return;
        }

        // Check if email is valid
        if (!isValidEmail(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        // Check if phone number has exactly 10 digits
        if (!isValidPhoneNumber(phonenumber)) {
            alert('Phone number should have exactly 10 digits.');
            return;
        }

        // Check if password has at least 8 characters
        if (password.length < 8) {
            alert('Password must have at least 8 characters.');
            return;
        }

        const formData = new FormData(form);

        // Use Axios to post form data to the insert.php file
        axios.post('includes/insert.php', formData)
            .then(response => {
                // Handle successful response, e.g., show success message
                alert(response.data[0].Message);
            })
            .catch(error => {
                // Handle error response, e.g., show error message to the user
                alert('Sign up failed. Please try again.');
                console.error(error);
            });
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhoneNumber(phoneNumber) {
        const phoneNumberRegex = /^\d{10}$/;
        return phoneNumberRegex.test(phoneNumber);
    }
</script>


</body>
</html>
