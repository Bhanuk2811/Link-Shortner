<?php
// AuthController.php

class AuthController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
 public function register($username, $password) {
        // Check if the username already exists
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Username already exists
            return "Username already taken. Please choose another.";
        } else {
            // Username is available, proceed with registration
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $passwordHash);

            if ($stmt->execute()) {
                // Successfully registered
                return "success";
            } else {
                // Handle other potential errors
                return "An error occurred during registration. Please try again later.";
            }
        }
    }
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['userid'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Successfully authenticated
                return true;
            } else {
                // Invalid password
                return false;
            }
        } else {
            // User not found
            return false;
        }
    }

}
?>
