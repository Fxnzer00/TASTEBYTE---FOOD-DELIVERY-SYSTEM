<?php
// Start or resume a session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
   <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 200px;
            background-color: #343a40;
            color: white;
            overflow-x: hidden;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #333;
        }

        .sidebar .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: #333;
            box-sizing: border-box;
        }

        .sidebar a:hover .submenu {
            display: block;
        }

        .sidebar .submenu a {
            padding-left: 20px;
        }

        .main {
            margin-left: 200px;
        }

        /* Dashboard Styles */
        .dashboard {
            padding: 20px;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="customer_order.php">Customer's Order</a>
        <a href="profile.php">Update Profile</a>
        <a href="showall_menu.php">Show All Menu</a>
        <a href="add_menu.php">Add New Menu</a>
        <a href="update_menu.php">Update Menu</a>
        <a href="delete_menu.php">Delete Menu</a>

    </div>

    <div class="main">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Restaurant Management System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="profile_info.php">Welcome, <?php echo $username; ?></a>
                        </li>
                       <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
       <main>
            <div class="dashboard">
                <h2>Dashboard</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-card" style="background: linear-gradient(to right, #3498db, #e74c3c); /* Gradient from blue to pink */">
                            <h4>Total Sales</h4>
                            <p>
                                
                                     <?php

                                        include 'config.php';


                                        // SQL query
                                        $sql = "SELECT SUM(total_amount) AS total_accepted_amount
                                                FROM order_condition
                                                WHERE status = 'ACCEPT' AND restaurant_id = '$user_id'";

                                        $result = $conn->query($sql);

                                        if ($result === FALSE) {
                                            die("Error executing query: " . $conn->error);
                                        }

                                        // Fetch the result
                                        $row = $result->fetch_assoc();

                                        // Output the sum
                                        $total_accepted_amount = $row['total_accepted_amount'];
                                        echo "RM $total_accepted_amount";

                                        // Close the connection
                                        $conn->close();
                                        ?>

                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h4>Total Daily Sales</h4>
                            <p>
                                

                                <?php
                                // Include the database configuration
                                include 'config.php';


                                // SQL query for daily sum of sales
                                $sql = "SELECT DATE(order_accept_date) AS order_date, SUM(total_amount) AS daily_sales
                                        FROM order_condition
                                        WHERE status = 'ACCEPT' AND restaurant_id = '$user_id'
                                        GROUP BY order_date";

                                $result = $conn->query($sql);

                                if ($result === FALSE) {
                                    die("Error executing query: " . $conn->error);
                                }

                                // Output the results
                                while ($row = $result->fetch_assoc()) {
                                    $order_date = $row['order_date'];
                                    $daily_sales = $row['daily_sales'];
                                    echo "Date: $order_date <br> Daily Sales: RM $daily_sales";
                                }

                                // Close the connection
                                $conn->close();
                                ?>


                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h4>Total Order</h4>
                            <p>
                                
                                <?php
                            // Include the database configuration
                            include 'config.php';

                            // SQL query for daily count of accepted orders
                            $sql = "SELECT COUNT(*) AS count1
                                    FROM order_condition
                                    WHERE status = 'ACCEPT' AND restaurant_id = '$user_id'";

                            $result = $conn->query($sql);

                            if ($result === FALSE) {
                                die("Error executing query: " . $conn->error);
                            }

                            // Fetch the result
                            $row = $result->fetch_assoc();

                            // Output the daily order count
                            $count1 = $row['count1'];
                            echo $count1;

                            // Close the connection
                            $conn->close();
                            ?>


                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h4>Total Daily Order</h4>
                            <p>
                                
                            <?php
                            // Include the database configuration
                            include 'config.php';


                            // SQL query for daily count of accepted orders
                            $sql = "SELECT DATE(order_accept_date) AS order_date, COUNT(*) AS daily_order_count
                                    FROM order_condition
                                    WHERE status = 'ACCEPT' AND restaurant_id = '$user_id'
                                    GROUP BY order_date";

                            $result = $conn->query($sql);

                            if ($result === FALSE) {
                                die("Error executing query: " . $conn->error);
                            }

                            // Output the results
                            while ($row = $result->fetch_assoc()) {
                                $order_date = $row['order_date'];
                                $daily_order_count = $row['daily_order_count'];
                                echo "Date: $order_date<br> Daily Order Count: $daily_order_count";
                            }

                            // Close the connection
                            $conn->close();
                            ?>


                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h4>Total Cancel Order</h4>
                            <p>
                                
                                <?php
                                    // Include the database configuration
                                    include 'config.php';

                                    // SQL query for daily count of rejected orders
                                    $sql = "SELECT COUNT(*) AS count2
                                            FROM order_condition
                                            WHERE status = 'REJECT' AND restaurant_id = '$user_id'";

                                    $result = $conn->query($sql);

                                    if ($result === FALSE) {
                                        die("Error executing query: " . $conn->error);
                                    }

                                    // Fetch the result
                                    $row = $result->fetch_assoc();

                                    // Output the count2 (daily reject count)
                                    $count2 = $row['count2'];
                                    echo $count2;

                                    // Close the connection
                                    $conn->close();
                                    ?>



                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h4>Total Menu</h4>
                            <p>
                                
                                <?php
                            // Include the configuration file
                            include('config.php');

                            // Now you can use $conn to execute your database queries
                            // Example:
                            $sql = "SELECT COUNT(*) as count_visible_menu_items FROM menu_items WHERE menu_visible = 1 AND restaurant_id = $user_id";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Fetch the result
                                $row = $result->fetch_assoc();
                                
                                // Access the count of visible menu items
                                $count_visible_menu_items = $row['count_visible_menu_items'];

                                echo $count_visible_menu_items;
                            } else {
                                echo "No results found";
                            }

                            // Close the database connection (optional, as it will be automatically closed when the script finishes)
                            $conn->close();
                            ?>



                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Add the following script for submenu -->
    <script>
    </script>
</body>
</html>
