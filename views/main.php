<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Link Shortener</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #43be;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 10px;
    }
    form {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type=url]{
        position: relative;
        width: 85%;
        padding: 25px;
        margin: 15px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    input[type=submit] {
        background-color: #007bff;
        color: white;
        cursor: pointer;
        padding: 25px;
        margin: 15px 0;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    input[type=submit]:hover {
        background-color: #0056b3;
    }


.logout-container  {
    position: fixed; /* Fixed positioning to keep it in view */
    top: 20px; /* Position from the top */
    right: 20px; /* Position from the right */
}



.logout-container input[type="submit"] {
    background-color: #dc3545; /* Red color for emphasis */
    color: white;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 20px;
    display: flex;
    border: none; /* Ensures no border */
    box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Add subtle shadow for depth */
    margin-top: 10px; /* Adds a bit of space between the buttons if needed */
}

.logout-container input[type="submit"]:hover {
    background-color: #c82333; /* Darker shade on hover */
}

.link-container {
    position: fixed;    
    margin-top: 35%;
    padding: 15px;
    background-color: #f0f8ff;
    border-radius: 5px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex; 
    flex-direction: column; /* Stack link and buttons vertically */
    align-items: center; /* Center-align the items */
}
.button-container  {
    display: flex; /* Enable flex layout */
    justify-content: space-around; /* Space out buttons evenly */
    
}
.button-container input[type="submit"] {
    background-color: #990099;
    padding: 10px 20px; /* Uniform padding */
    margin: 0 5px; /* Space between buttons */
    width: auto; /* Auto width based on content */
    border-radius: 5px; /* Rounded corners */
}


.link-container a {
    font-size: 20px;
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.link-container a:hover {
    color: #0056b3;
}

.links-list-container {
    position: fixed;
    bottom: 10px;
    width: 100%;
    text-align: center;
}

  

</style>
</head>
<body>
    
     <?php if(isset($shortCode) && !empty($shortCode)): ?>
      <!-- Short URL Display -->
<div class="link-container">
    
    <a href='./controllers/redirect.php?code=<?= htmlspecialchars($shortCode) ?>' target='_blank'>
        shorturl.com/<?= htmlspecialchars($shortCode) ?>
        
    </a>
     <div class="button-container">
        <form action="./views/delete.php" method="POST">
            <input type="submit" value="Delete" class="button">
        </form>
        <form action="./views/display-link.php" method="POST">
            <input type="submit" value="All Links" class="button">
        </form>
    </div>
    
</div>
      
    <?php endif; ?>
    <div class="logout-container">
        <form action="./views/login.php" method="POST"> 
            <input type="submit" value="Logout">
        </form>
        
    </div>

    <form action="index.php" method="POST">
        <input type="url" name="url" placeholder="Enter your URL here" required>
        <input type="submit" value="Shorten">
    </form>

 
</body>

</html>

