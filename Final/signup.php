<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'dt';

// Database connection setup
$conn = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Initialize variables
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $city = $conn->real_escape_string($_POST['city']);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO signup (username, email, password, mobile, city) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $mobile, $city);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* Basic styling for the sign-up form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: green;
        }

    </style>
</head>
<body>

<div class="signup-container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST" id="signupForm" onsubmit="return validateForm()">
        
        <!-- Username Field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <!-- Email Field -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <span id="emailError" class="error"></span>

        <!-- Password Field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <!-- Mobile Number Field -->
        <label for="mobile">Mobile No:</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" maxlength="10" required placeholder="Enter 10-digit mobile number">
        <span id="mobileError" class="error"></span>

        <!-- City Field -->
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required placeholder="Enter your city">

        <button type="submit">Sign Up</button>
    </form>

    <!-- Display success/error message -->
    <div class="message">
        <?php echo $message; ?>
    </div>
</div>

<script>
    // Function to validate the form before submission
    function validateForm() {
        // Validate Email
        var email = document.getElementById('email').value;
        var emailError = document.getElementById('emailError');
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
            emailError.textContent = "Invalid email format.";
            return false;  // Prevent form submission
        } else {
            emailError.textContent = "";
        }

        // Validate Mobile Number
        var mobile = document.getElementById('mobile').value;
        var mobileError = document.getElementById('mobileError');
        var mobileRegex = /^[0-9]{10}$/;  // Validates a 10-digit number
        if (!mobileRegex.test(mobile)) {
            mobileError.textContent = "Please enter a valid 10-digit mobile number.";
            return false;  // Prevent form submission
        } else {
            mobileError.textContent = "";
        }

        return true;  // If everything is valid, the form will be submitted
    }
</script>

</body>
</html>
