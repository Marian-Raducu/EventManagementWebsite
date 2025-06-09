<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "userdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch event details
$sql = "SELECT name, email, message FROM user_data";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Event Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/upcoming-events.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h1>School Events!</h1>
        <a href="logout.php">Logout</a>
    </header>

    <nav>
        <ul>
            <li><a href="events.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>Event Details</h2>
        <ul>
            <!-- Existing events -->
            <li>Colage fest</li>
            <img src="PicturesWeb/collage fest.jpg" width="200" />
            <li>School Party</li>
            <img src="PicturesWeb/school party.jpg" width="200" />
            <li>NightOut</li>
            <img src="PicturesWeb/nightparty.png" width="200" />
            <!-- Add more event details as needed -->

            <?php
            // Check if there are events fetched from the database
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["name"] . "</li>";
                    // You can add additional details here
                }
            }
            ?>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 events.com by Marian</p>
    </footer>
</body>
</html>
