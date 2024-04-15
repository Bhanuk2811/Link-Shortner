<?php
session_start(); // Start the session

require_once '../core/db.php'; // Include your database connection settings
require_once '../controllers/AuthController.php'; // Include the AuthController class

$authController = new AuthController($conn); // Initialize AuthController with DB connection

$error = ''; // Initialize an error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Get the password from POST data

    $registrationResult = $authController->register($username, $password);

    if ($registrationResult === "success") {
        // If successful, set session variables and redirect to the main page
        $_SESSION['userid'] = $conn->insert_id; // Get the ID of the newly created user record
        $_SESSION['username'] = $username;
        header("Location: ../index.php"); // Redirect to the main page
        exit();
    } else {
        // Display error message from registration attempt
        $error = $registrationResult;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="form-container">
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="register.php" method="POST" class="register-form">
        <h2>Register</h2>
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
            <input type="submit" value="Register">
        </div>
    </form>
</div>
</body>
</html>

