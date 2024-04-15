<?php
session_start();

include '../core/db.php';

if (isset($_GET['code'])) {
    $shortCode = $_GET['code'];
    
    $stmt = $conn->prepare("SELECT original_url FROM links WHERE short_code = ?");
    $stmt->bind_param("s", $shortCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Location: " . $row['original_url']);
        exit();
    } else {
        echo "Short code not found.";
    }
}
?>
