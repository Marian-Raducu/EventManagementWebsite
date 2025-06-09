<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: events.php"); // Redirect to the events page 
    exit();
}


// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $deleteId = $_POST["deleteId"];

    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deleteQuery = "DELETE FROM user_data WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $deleteId);
    $deleteStmt->execute();

    $deleteStmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
	<link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/Delete.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>

        <header>
        <h2>Delete Page</h2>
        </header>

   <nav>
<?php
// Display the delete buttons
$conn = new mysqli("localhost", "root", "", "userdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = "SELECT id, name, email, message FROM user_data";
$searchResult = $conn->query($searchQuery);

if ($searchResult->num_rows > 0) {
    echo "Name  Email  Message <br>";

    while ($row = $searchResult->fetch_assoc()) {
        echo $row['name']."  ".$row['email']."  ".$row['message']."  ";

        // Delete button
        echo '<form action="" method="post">';
        echo '<input type="hidden" name="deleteId" value="' . $row['id'] . '">';
        echo '<button type="submit" name="delete">Delete</button>';
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
