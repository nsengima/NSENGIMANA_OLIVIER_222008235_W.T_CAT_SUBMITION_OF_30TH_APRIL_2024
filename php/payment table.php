 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAILOR SHOP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            height: 50px;
            text-align: center;
            padding: 25px;
            color: white;
            background-color: blue;
        }
    </style>
</head>
<body>
    <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success search-button" type="submit">Search</button>
</form>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold;">ONLINE TAILORING MANAGEMENT SYSTEM</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold;">LIST OF  USER PAID  GARMENT IN TAILOR SHOP</h4>
        <a href="payment form.html" class="btn btn-primary" style="margin-top: 0px;">New customer</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 100px;">Back Home</a>
        <table class="table table-bordered">
            <thead class="bg-warning">
                <tr>
                    <th>payment_id</th>
                    <th>payment_date</th>
                    <th>Payment_method</th>
                    <th>Amount</th>
                    <th>ordes_id</th>
                    <th>user_id</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connection details
                $host = "localhost";
                $user = "root";
                $pass = "";
                $database = "tailordb";

                // Creating connection
                $connection = new mysqli($host, $user, $pass, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // SQL query to fetch data from the payment table
                $sql = "SELECT * FROM payment";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['payment_id'] . "</td>
                                <td>" . $row['payment_date'] . "</td>
                                <td>" . $row['payment_method'] . "</td>
                                <td>" . $row['amount'] . "</td>
                                <td>" . $row['ordes_id'] . "</td>
                                <td>" . $row['user_id'] . "</td>
                                <td><a href='deletepayment.php?payment_id=" . $row['payment_id'] . "'>Delete</a></td>
                                <td><a href='updatepayment.php?payment_id=" . $row['payment_id'] . "'>update</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                // Close the database connection
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
    <footer><!-- Footer section -->
        <p>&copy; &reg; 2024 UR CBE BIT YEAR 2 @ Group A</p><!-- Copyright and trademark notice -->
    </footer><!-- Footer section -->
</body>
</html>
