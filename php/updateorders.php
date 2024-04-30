<?php
include('dbconnection.php');

// Check if Product_Id is set
if (isset($_REQUEST['ordes_id'])) {
  $ordes_id = $_REQUEST['ordes_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM orders WHERE ordes_id=?");
  $stmt->bind_param("i", $ordes_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['ordes_id'];
    $y = $row['user_id'];
    $z = $row['orders_date'];
    $w = $row['total_amount'];
    
  } else {
    echo "orders not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update orders</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update orders form -->
    <h2><u>Update Form of orders</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="user_id">user_id:</label>
    <input type="number" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="orders_date">orders date:</label>
    <input type="date" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="total_amount">total total:</label>
    <input type="text" name="role" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    

    <input type="submit" name="up" value="Update">

  </form>
   <a href="orders table.php" class="btn btn-primary" style="margin-top: 0px;">back to orders</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $user_id= $_POST['user_id'];
  $orders_date= $_POST['orders'];
  $total_amount = $_POST['total_amount'];
 



  // Update the product in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE orders SET user_id=?, orders_date=?, total_amount=?, WHERE ordes_id=?");
  $stmt->bind_param("idsi", $user_id, $orders_date, $total_amount, $ordes_id);
  $stmt->execute();

  // Redirect to product.php
  header('Location: orders table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>