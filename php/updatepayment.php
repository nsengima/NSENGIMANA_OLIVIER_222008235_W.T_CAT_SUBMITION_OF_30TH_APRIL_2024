<?php
include('dbconnection.php');

// Initialize variables to avoid undefined index notice
$y = $z = $w = $s = $t = '';

// Check if payment_id is set
if (isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $conn->prepare("SELECT * FROM payment WHERE payment_id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['payment_date'];
        $z = $row['payment_method'];
        $w = $row['amount'];
        $s = $row['ordes_id'];
        $t = $row['user_id'];
    } else {
        echo "Payment not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record from payment?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="payment_date">Payment date:</label>
        <input type="date" name="payment_date" value="<?php echo $y; ?>">
        <br><br>

        <label for="payment_method">Payment method:</label>
        <input type="text" name="payment_method" value="<?php echo $z; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" value="<?php echo $w; ?>">
        <br><br>

        <label for="ordes_id">Order ID:</label>
        <input type="number" name="ordes_id" value="<?php echo $s; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $t; ?>">
        <br><br>

        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
        <input type="submit" name="up" value="Update">
    </form>
    <a href="payment table.php" class="btn btn-primary" style="margin-top: 0px;">Back to Payment</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $payment_id = $_POST['payment_id'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];
    $ordes_id = $_POST['ordes_id'];
    $user_id = $_POST['user_id'];

    // Update the payment in the database (prepared statement again for security)
    $stmt = $conn->prepare("UPDATE payment SET payment_date=?, payment_method=?, amount=?, ordes_id=?, user_id=? WHERE payment_id=?");
    $stmt->bind_param("ssiiii", $payment_date, $payment_method, $amount, $ordes_id, $user_id, $payment_id);
    $stmt->execute();

    // Redirect to payment_table.php
    header('Location: payment table.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>
