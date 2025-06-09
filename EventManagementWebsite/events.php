<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/welcome.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h1>Welcome </h1>
    </header>

    <nav>
            
               <li><a href="event_details.php">Event Details</a></li>
               <li><a href="member_details.php">Member Details</a></li>
               <li><a href="add_event.php">Add Event Details</a></li>
			   <li><a href="search.php">Search</a></li>
			   <li><a href="edit.php">Edit</a></li>
			   <li><a href="delete.php">Delete</a></li>
               <li><a href="logout.php">Logout</a></li>
              
    </nav>

    <section>
        <p>It’s not a store – it’s an experience!</p>
    </section>

    <footer>
        <p> &copy; 2024 events.com by Marian
    </footer>
</body>
</html>