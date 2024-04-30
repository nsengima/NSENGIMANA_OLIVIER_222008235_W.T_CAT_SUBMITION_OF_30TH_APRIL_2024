<?php
include('dbconnection.php');

// Check if username is set
if (isset($_REQUEST['username'])) {
  $username = $_REQUEST['username'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $conn->prepare("SELECT * FROM register WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $x = $row['username'];
    $y = $row['email'];
    $z = $row['password'];
    $w = $row['address'];
   
  } else {
    echo "user not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update register</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update register form -->
    <h2><u>Update Form of register</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    
    <label for="email">email:</label>
    <input type="text" name="eml" value="<?php echo isset($y) ? $y : ''; ?>">
    <br><br>

    <label for="password">password:</label>
    <input type="text" name="psw" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>

    <label for="caddress">address:</label>
    <input type="text" name="address" value="<?php echo isset($w) ? $w : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
  <a href="register table.php" class="btn btn-primary" style="margin-top: 0px;">back register</a>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from 
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];



  // Update the register in the database (prepared statement again for security)
  $stmt = $conn->prepare("UPDATE register SET  email=?, password=?,address=? WHERE username=?");
  $stmt->bind_param("ssss", $email, $password,$address, $username);
  $stmt->execute();

  // Redirect to register table.php
  header('Location: register table.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($conn);
?>