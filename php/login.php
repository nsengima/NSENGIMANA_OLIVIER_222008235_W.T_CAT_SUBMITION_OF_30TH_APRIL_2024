<?php
session_start(); // Start the session to use session variables

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailordb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT  email FROM register WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the ID from the query result
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Store both username and ID in the session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Redirect to home.html
        header("Location: home.html");
        exit();
    } else {
        echo "Invalid username or password";
        exit;
    }
}

$conn->close();
?>
