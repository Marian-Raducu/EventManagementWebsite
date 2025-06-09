<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page 
    exit();
}

// Handle edit request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $editId = $_POST["editId"];

    // Redirect to the edit page with the record ID
    header("Location: edit_record.php?id=" . $editId);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/EditEvents.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h2>Edit Page</h2>
    </header>

    <nav>
        <?php
        // Display the edit buttons
        $conn = new mysqli("localhost", "root", "", "userdb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $searchQuery = "SELECT id, name AS event_title, email AS event_description, message AS event_date FROM user_data";
        $searchResult = $conn->query($searchQuery);

        if ($searchResult->num_rows > 0) {
            echo "<h3>Records</h3>";

            while ($record = $searchResult->fetch_assoc()) {
                echo "<p>Event Title: " . $record['event_title'] . "</p>";
                echo "<p>Event Description: " . $record['event_description'] . "</p>";
                echo "<p>Event Date: " . $record['event_date'] . "</p>";

                // Edit button
                echo '<form action="edit_record.php" method="get">';
                echo '<input type="hidden" name="editId" value="' . $record['id'] . '">';
                echo '<button type="submit" name="edit">Edit</button>';
                echo '</form>';

                echo "<br>";
            }
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
		
		    <!-- Back Button -->
    <form action="events.php" method="get">
        <input type="submit" name="back" value="Back">
    </form>
	
    </nav>

    <footer>
        <p>&copy; 2024 events.com by Marian</p>
    </footer>
</body>
</html>
