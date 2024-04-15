<?php
session_start(); // Start the session at the beginning

// Include necessary files
require_once './core/db.php'; 
require_once './models/LinkModel.php';
require_once './controllers/LinkController.php';

// Initialize Database Connection
$conn = require './core/db.php'; 


$linkModel = new LinkModel($conn);
$linkController = new LinkController($linkModel);

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ./views/login.php");
    exit(); // Prevent further execution of the script
}

// Process form submission for creating a short link
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['url'])) {
    $originalUrl = $_POST['url'];
    $shortCode = $linkController->createShortLink($originalUrl);
    if (!$shortCode) {
        $errorMessage = "Invalid URL.";
    }
}


include './views/main.php'; //

?>
