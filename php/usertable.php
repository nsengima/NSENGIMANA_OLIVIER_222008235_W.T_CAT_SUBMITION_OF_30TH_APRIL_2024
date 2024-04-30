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
        <h4 style="text-align: center; font-family: century; font-weight: bold;">LIST OF USERS IN OUR SYSTEM</h4>
        <a href="user form.php" class="btn btn-primary" style="margin-top: 10px;">New User</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 10px;">Back Home</a>
        <table class="table table-bordered">
            <thead class="bg-warning">
                <tr>
                    <th>user_id</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>role</th>
                    <th>contact</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connection details
                include "dbconnection.php";

                // Establish connection
                $connection = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // SQL query to fetch data from the user table
                $sql = "SELECT * FROM user";
                $result = $connection->query($sql);

                // Check if there are any users
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['user_id'] . "</td>
                            <td>" . $row['first_name'] . "</td>
                            <td>" . $row['last_name'] . "</td>
                            <td>" . $row['role'] . "</td>
                            <td>" . $row['contact'] . "</td>
                            <td><a style='padding:4px' href='deleteuser.php?user_id={$row['user_id']}'>Delete</a></td>
                            <td><a style='padding:4px' href='updateuser.php?user_id={$row['user_id']}'>Edit</a></td> 
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
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
