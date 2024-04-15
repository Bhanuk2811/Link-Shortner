<?php
include '../core/db.php'; 

$sql = "SELECT original_url, short_code FROM links"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Links</title>
</head>
<body>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .links-container2 {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .links-container2 ul {
    list-style-type: square; /* Change list style to square bullet points */
    margin: 0;
    padding-left: 20px; /* Adjust padding to ensure alignment */
}

.links-container2 li {
    background-color: #ffffff;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    list-style-position: inside; /* Ensures the square bullets are aligned within the padding of the list items */
}


        .links-container2 a {
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links-container2 a:hover, .links-container2 a:focus {
            color: #0056b3;
        }

        /* Adding a class for the link code display for better styling */
        .link-code {
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 2px 8px;
            font-family: monospace;
            color: #495057;
        }
    </style>
    <h2>Your Links</h2>
    <?php
    if ($result && $result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $url = htmlspecialchars($row["original_url"]);
            $shortCode = htmlspecialchars($row["short_code"]);
            echo "<li><a href='$url' target='_blank'>$url, $shortCode</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No links found.";
    }

    ?>
</body>
</html>
