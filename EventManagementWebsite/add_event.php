<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page if not logged in
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $event_title = $_POST["event_title"];
    $event_description = $_POST["event_description"];
    $event_date = $_POST["event_date"];

    // Insert event details into the database
    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user ID from session
    $user_id = $_SESSION["user_id"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO user_data (user_id, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_id, $event_title, $event_description, $event_date);
    $stmt->execute();

    // Check if the event was successfully added
    if ($stmt->affected_rows > 0) {
        $message = "Event added successfully!";
    } else {
        $error = "Failed to add event. Please try again.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Add Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/Add-events.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h1>New Event in School</h1>
        <a href="logout.php">Logout</a>
    </header>

    <nav>
        <ul>
            <li><a href="events.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>Add Event Details</h2>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php elseif (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="add_event.php" method="post"> <!-- Submit form data to add_event.php -->
            <label for="event-title">Event Title:</label>
            <input type="text" id="event-title" name="event_title" required>

            <label for="event-description">Event Description:</label>
            <textarea id="event-description" name="event_description"></textarea>

            <label for="event-date">Event Date:</label>
            <input type="date" id="event-date" name="event_date" required>

            <button type="submit">Add Event</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 events.com by Marian</p>
    </footer>
</body>
</html>
