<?php
include('dbconnection.php');

// Check if Product_Id is set
if (isset($_REQUEST['stock_id'])) {
  $pid = $_REQUEST['stock_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM stock WHERE stock_id=?");
  $stmt->bind_param("i", $stock_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['stock_id'];
    $y = $row['item_name'];
    $z = $row['quantity_available'];
    $w = $row['price'];
    $s = $row['time_in_stock'];
    $t = $row['order_id'];
    $r = $row['payment_id'];

  } else {
    echo "stock not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update stock</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of stock</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="item_name">item name:</label>
    <input type="text" name="pname" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="quantity_available">quantity available:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="price">price:</label>
    <input type="number" name="frw" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="time_in_stock">time_in_stock:</label>
    <input type="date" name="tsk" value="<?php echo isset($s) ? $s : ''; ?>">
    <br><br>

    <label for="order_id">order_id:</label>
    <input type="number" name="tsk" value="<?php echo isset($t) ? $t : ''; ?>">
    <br><br>

    <label for="payment_id">payment_id:</label>
    <input type="number" name="tsk" value="<?php echo isset($r) ? $r : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="stock table.php" class="btn btn-primary" style="margin-top: 0px;">back to stock</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $item_name = $_POST['item_name'];
  $quantity_available = $_POST['quantity_available'];
  $price = $_POST['price'];
  $time_in_stock = $_POST['time_in_stock'];



  // Update the product in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE stock SET item_name=?, quantity_available=?, price=?,time_in_stock=?,order_id=?,payment_id=? WHERE stock_id=?");
  $stmt->bind_param("ssidiii", $item_name, $quantity_available, $price,$time_in_stock,$order_id,$payment_id,$stock_id);
  $stmt->execute();

  // Redirect to product.php
  header('Location: stock table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>