<?php
session_start();

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "userdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user details from the 'users' table
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username; // Store username in session for future use
            $_SESSION["user_id"] = $row["id"]; // Store user ID in session

            //Redirect user to Home page
            header('location: events.php');

        } else {
            echo "Invalid password or username";
        }
    } else {
        echo "User not found";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/logging.png') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>

    <header>
        <h1>Login</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            
        </ul>
    </nav>

    <section>
    <h2>Login into your account</h2>    

    <form action="login.php" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>

        <div>
            <input type="submit" value="Login">
        </div>
        <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
    </form>       
    </section>

    </section>

    <footer>
        <p> &copy; 2024 events.com by Marian
    </footer>
    
</body>
</html>
