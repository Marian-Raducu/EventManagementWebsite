<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "userdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user details into the 'users' table
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        //Redirect to login page
        header('location: login.php');

        //echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
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
            background: url('PicturesWeb/SignUp.png') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>

    <header>
        <h1>Sign Up</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            
        </ul>
    </nav>

    <section>
    <h2>Create an account</h2>    

    <form action="signup.php" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password">
        </div>

        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>       
    </section>
   
    <footer>
        <p> &copy; 2024 events.com by Marian
    </footer>
    
</body>
</html>