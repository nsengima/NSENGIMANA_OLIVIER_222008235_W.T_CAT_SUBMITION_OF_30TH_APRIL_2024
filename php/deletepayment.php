<?php
include('dbconnection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM payment WHERE payment_id=?");
    $stmt->bind_param("i", $payment_id);
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
    echo "<p>Deleting record with payment ID: $payment_id</p>";
    ?>

    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
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
    <a href="payment table.php" class="btn btn-primary" style="margin-top: 0px;">back to payment</a>
</body>
</html>
<?php
    // Close the prepared statement
    $stmt->close();
} else {
    echo "payment ID is not set.";
}

// Close the database connection
$conn->close();
?>
