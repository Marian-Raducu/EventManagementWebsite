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
            background: url('PicturesWeb/Welcome-to-our-events.png') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h1>Welcome to my Events</h1>
    </header>

    <nav>
        <ul>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
                
            <?php else: ?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="event_details.php">Events</a></li>
              
            <?php endif; ?>
        </ul>
    </nav>

        </form>
    <section>
        <p></p>
    </section>

    <footer>
        <p> &copy; 2024 events.com by Marian
    </footer>
</body>
</html>