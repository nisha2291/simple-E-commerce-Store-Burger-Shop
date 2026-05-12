<?php
// su.php

// Start the session
session_start();

// Database connection settings (adjust these as needed)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and retrieve the form data
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
$stmt->bind_param("ss", $name, $password);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, create a session
    $_SESSION['name'] = $name;
    echo "Login successful. Welcome, " . $name . "!";
    // Redirect to a different page if needed
    // header("Location: welcome.php");
} else {
    // User not found
    echo "Invalid name or password.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

