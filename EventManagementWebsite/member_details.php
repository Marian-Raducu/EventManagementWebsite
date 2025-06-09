<!-- member_details.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Member Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('PicturesWeb/Members.webp') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
    }
    </style>
<body>
    <header>
        <h1>Members</h1>
        <a href="logout.php">Logout</a>
    </header>

    <nav>
        <ul>
		    <li><a href="events.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
            
        </ul>
    </nav>

    <section class="content">
        <h2>Member Details</h2>
        <ul>
            <li>Paul</li>
            <li>Mathew</li>
            <li>Rose</li>
            <!-- Add more member details as needed -->
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 events.com by Marian</p>
    </footer>
</body>
</html>
