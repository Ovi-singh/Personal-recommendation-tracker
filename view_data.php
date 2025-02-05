<?php
// Database connection settings
$servername = "localhost:4306";
$username = "root";
$password = ""; // Leave password blank if you're using the default root without password
$dbname = "feedback_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the feedback table
$sql = "SELECT name, rating, review FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css"> <!-- Link to the CSS file -->
    <title>Feedback Data</title>
</head>
<body>
    <h1>Feedback Submitted</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are records in the table
            if ($result->num_rows > 0) {
                // Output each row from the database
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['rating']) . "</td><td>" . htmlspecialchars($row['review']) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
