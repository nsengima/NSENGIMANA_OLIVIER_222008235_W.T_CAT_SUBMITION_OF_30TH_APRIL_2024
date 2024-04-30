<?php
include"dbconnection.php";

$conn->select_db($dbname);

$sql = "INSERT INTO register (`username`, `password`, `email`, `address`)
VALUES ('$_POST[username]','$_POST[password]', '$_POST[email]','$_POST[address]')";


if ($conn->query($sql) === TRUE) {
    echo " data inserted successfully<br>";
    header("location:index.php");
} else {
    echo "Error inserting sample data: " . $conn->error;
}

// Close connection
$conn->close();
?>