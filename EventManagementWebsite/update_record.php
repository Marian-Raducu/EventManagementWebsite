<?php

// Update request
$updateId = isset($_POST["updateId"]) ? $_POST["updateId"] : '';
$updatedName = isset($_POST["updateName"]) ? $_POST["updateName"] : '';
$updatedEmail = isset($_POST["updateEmail"]) ? $_POST["updateEmail"] : '';
$updatedMessage = isset($_POST["updateMessage"]) ? $_POST["updateMessage"] : '';



// Update the record in the database
$conn = new mysqli("localhost", "root", "", "userdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$updateQuery = "UPDATE user_data SET name=?, email=?, message=? WHERE id=?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("sssi", $updatedName, $updatedEmail, $updatedMessage, $updateId);

if ($updateStmt->execute()) {
    echo "Record updated successfully!";
} else {
    echo "Error updating record: " . $updateStmt->error;
}

$updateStmt->close();
$conn->close();
?>
