<?php
include('dbconnection.php');

// Check if Product_Id is set
if (isset($_REQUEST['user_id'])) {
  $pid = $_REQUEST['user_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM user WHERE user_id=?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['user_id'];
    $y = $row['fairst_name'];
    $z = $row['last_name'];
    $w = $row['role'];
    $s = $row['contact'];
  } else {
    echo "user not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update user</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of user</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="fname">first name:</label>
    <input type="text" name="pname" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="lname">last name:</label>
    <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="role">role:</label>
    <input type="text" name="role" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <label for="contact">Contact:</label>
    <input type="number" name="contact" value="<?php echo isset($s) ? $s : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
   <a href="usertable.php" class="btn btn-primary" style="margin-top: 0px;">back to register</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $first_name = $_POST['fname'];
  $last_name = $_POST['lname'];
  $role = $_POST['role'];
  $contact = $_POST['contact'];



  // Update the product in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE user SET first_name=?, last_name=?, role=?,contact=? WHERE user_id=?");
  $stmt->bind_param("sssii", $first_name, $last_name, $role,$contact, $user_id);
  $stmt->execute();

  // Redirect to product.php
  header('Location: usertable.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>