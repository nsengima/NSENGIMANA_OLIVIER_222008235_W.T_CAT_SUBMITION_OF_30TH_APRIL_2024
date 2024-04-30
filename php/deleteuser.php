<?php
include('dbconnection.php');

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
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
    echo "<p>Deleting record with user ID: $user_id</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
    <a href="usertable.php" class="btn btn-primary" style="margin-top: 0px;">back to user</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "User ID is not set.";
}

// Close the database connection
$conn->close();
?>
