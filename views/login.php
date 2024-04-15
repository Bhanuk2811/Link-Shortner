<?php
session_start();
require '../core/db.php'; // Ensure this file establishes the database connection
require '../controllers/AuthController.php'; // Adjust path as needed

$errorMessage = ''; // Initialize an empty error message string

// Create an instance of AuthController with the database connection
$authController = new AuthController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    if ($authController->login($username, $password)) {
        // Login successful
        $_SESSION['username'] = $username; // Make sure to assign the username to session
        header("Location: ../index.php"); // Redirect to the main page
        exit();
    } else {
        // Login failed
        $errorMessage = "Invalid username or password.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to your CSS file -->
</head>
<body>
<div class="login-container">
    <h2>Login to Your Account</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Login">
        </div>
        <?php if (!empty($errorMessage)): ?>
    <div class="error-message">
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</div>
</body>
</html>
