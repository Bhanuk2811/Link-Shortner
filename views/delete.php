
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Deletion Confirmation</title>
    <style>
        #delete-message {
            color: #ffffff; /* White text color */
            background-color: #e04141; /* Green background */
            padding: 20px; /* Padding inside the box */
            margin: 20px 0; /* Margin outside the box */
            text-align: center; /* Center the text */
            border-radius: 10px; /* Rounded corners */
            font-size: 24px; /* Larger text size */
            font-family: Arial, sans-serif; /* Font family */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow for depth */
        }
    </style>
</head>
<body>
    <?php
include '../core/db.php'; 

// Prepare and execute the SQL statement
$stmt = "DELETE FROM links LIMIT 1"; // Use prepared statements to avoid SQL injection
$result = $conn->query($stmt);

// Check if the deletion was successful
if ($result) {
    echo '<div id="delete-message">Your link is deleted</div>';
} else {
    echo 'Error: ' . $conn->error;
}

// Close the database connection
$conn->close();
?>

</body>
</html>

