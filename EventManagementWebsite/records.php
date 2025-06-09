<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Retrieve user details from the session
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;

// Retrieve all saved user data from the database
if ($user_id > 0) {
    $conn = new mysqli("localhost", "root", "", "userdb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userDataQuery = "SELECT name, email, message FROM user_data WHERE user_id = ?";
    $userDataStmt = $conn->prepare($userDataQuery);
    $userDataStmt->bind_param("i", $user_id);
    $userDataStmt->execute();
    $userDataResult = $userDataStmt->get_result();

    $row=$userDataResult->fetch_assoc();

    $userDataStmt->close();
    $conn->close();
}

// Back button logic
if (isset($_POST['back'])) {
    header("Location: login.php"); // Redirect to the login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>

    <?php
    if (!empty($row)) {
        // Display saved user data with headings
      
       echo "Name  Email  Message <br>";
       
       while($row !== null) {
       echo $row['name']."  ".$row['email']."  ".$row['message']."<br>";
       $row=$userDataResult->fetch_assoc();

}
    }else {
        echo "No records found.";
    }
    ?>

    <!-- Back Button -->
    <form action="" method="post">
        <input type="submit" name="back" value="Back">
    </form>
</body>
</html>
