<?php
include('dbconnection.php');

// Check if user_id is set
if(isset($_REQUEST['username'])) {
    $username = $_REQUEST['username'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM register WHERE username=?");
    $stmt->bind_param("s", $username);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <?php
    // Display a message indicating which record will be deleted
    echo "<p>Deleting record with user ID: $username</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute the DELETE statement
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
    <a href="register table.php" class="btn btn-primary" style="margin-top: 0px;">back to register</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "register ID is not set.";
}

// Close the database connection
$conn->close();
?>
