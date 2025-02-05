<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost:4306";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "feedback_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input data to prevent security issues
$type = mysqli_real_escape_string($conn, $_POST['type']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$rating = mysqli_real_escape_string($conn, $_POST['rating']);
$review = mysqli_real_escape_string($conn, $_POST['review']);

// Prepare and bind the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO feedback (type, name, rating, review) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $type, $name, $rating, $review);

// Execute the prepared statement

if ($stmt->execute()) {
    // Success: Redirect back to the form page
    header("Location: form.html?status=success");
    exit(); // Stop further script execution
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
