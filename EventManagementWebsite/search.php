<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page if not logged in
    exit();
}

// Back button logic
if (isset($_POST['back'])) {
    header("Location: events.php"); // Redirect to the events page
    exit();
}

$searchResultsFile = []; // Array to store file search results
$searchResultsDB = [];   // Array to store database search results
$fileSearchPerformed = false;
$dbSearchPerformed = false;

// Handle file search request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["searchTerm"];

    // Load the event details from event_details.php
    $eventDetails = file_get_contents("event_details.php");

    // Extract content from the section with class "content"
    preg_match('/<section class="content">(.*?)<\/section>/s', $eventDetails, $matches);

    // Search for the events based on the search term within the extracted content
    if (isset($matches[1])) {
        preg_match_all("/<li>(.*?)<\/li>/s", $matches[1], $eventMatches);
        foreach ($eventMatches[1] as $match) {
            if (stripos($match, $searchTerm) !== false) {
                $searchResultsFile[] = $match;
            }
        }
    }
    $fileSearchPerformed = true;
}

// Handle database search request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $searchTerm = $_POST["searchTerm"];

    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchQuery = "SELECT name, email, message FROM user_data WHERE name LIKE ? OR email LIKE ? OR message LIKE ?";
    $searchStmt = $conn->prepare($searchQuery);
    $searchTermDB = "%" . $searchTerm . "%";
    $searchStmt->bind_param("sss", $searchTermDB, $searchTermDB, $searchTermDB);
    $searchStmt->execute();
    $searchResultDB = $searchStmt->get_result();

    while ($row = $searchResultDB->fetch_assoc()) {
        $searchResultsDB[] = $row['name'];
    }

    $searchStmt->close();
    $conn->close();
    $dbSearchPerformed = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Display</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/Search.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h2>Search and Display</h2>
    </header>
    
    <nav>
    <!-- Search Form -->
    <form action="" method="post">
        <label for="searchTerm">Search:</label>
        <input type="text" name="searchTerm" required>
        <input type="submit" name="search" value="Search">
    </form>
    </nav>
     
    <?php
    // Display file search results
    if ($fileSearchPerformed) {
        if (!empty($searchResultsFile)) {
            echo "<h3>File Search Results:</h3>";
            echo "<ul>";
            foreach ($searchResultsFile as $result) {
                echo "<li><a href='event_details.php'>$result</a></li>";
            }
            echo "</ul>";
        }
    } elseif (isset($searchResult)) {
        echo "No results found.";
    }

    // Display database search results
    if ($dbSearchPerformed) {
        if (!empty($searchResultsDB)) {
            echo "<h3>Database Search Results:</h3>";
            echo "<ul>";
            foreach ($searchResultsDB as $result) {
                echo "<li>$result</li>";
            }
            echo "</ul>";
        }
    } elseif (isset($searchResult)) {
        echo "No results found.";
    }

    ?>
      
    <!-- Back Button -->
    <form action="events.php" method="get">
        <input type="submit" name="back" value="Back">
    </form>
    
    <footer>
        <p>&copy; 2024 events.com by Marian</p>
    </footer>
</body>
</html>
