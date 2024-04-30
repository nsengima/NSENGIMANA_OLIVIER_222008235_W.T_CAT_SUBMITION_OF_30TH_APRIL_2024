<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tailordb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'orders' => "SELECT orders_id FROM orders WHERE orders_id LIKE '%$searchTerm%'",
        'payment' => "SELECT payment_id FROM payment WHERE payment_id LIKE '%$searchTerm%'",
        'register' => "SELECT username FROM register WHERE username LIKE '%$searchTerm%'",
        'stock' => "SELECT stock_id FROM stock WHERE stock_id LIKE '%$searchTerm%'",
        'user' => "SELECT user_id FROM user WHERE user_id LIKE '%$searchTerm%'",
       
    ];

    // Output search results
    echo "<style>
                h2 {
                    color: blue;
                    text-decoration: underline;
                }
                h3 {
                    color: green;
                }
                p {
                    color: black;
                }
          </style>";
    echo "<h2>Search Results:</h2>";

    foreach ($queries as $table => $sql) {
        $result = $conn->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $conn->close();
} else {
    echo "<p>No search term was provided.</p>";
}
}
?>


