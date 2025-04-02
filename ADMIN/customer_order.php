<?php
// Include the database configuration
include 'config.php';

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

// Fetch data from the order_place table for a specific user and restaurant with status "Pending"
$restaurant_id = $user_id; // Replace 123 with the actual restaurant_id
$sql = "SELECT
            user_id,
            name,
            address,
            phone,
            total_price,
            status,
            GROUP_CONCAT(CONCAT(item_name, ' - ', '×', quantity, ' - ', 'RM ', price) ORDER BY item_name ASC SEPARATOR '<br>') AS items_info,
            order_date
        FROM order_place
        WHERE restaurant_id = $restaurant_id AND status = 'Pending'
        GROUP BY name, address, phone, order_date";
$result = $conn->query($sql);
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
    /* Sidebar Styles */
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

    /* Main Content Styles */
    .main {
        margin-left: 200px;
    }

    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    /* Animation for table rows */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .table tbody tr {
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Responsive Styles for Smaller Screens */
    @media (max-width: 767px) {
        .sidebar {
            width: 100%;
            position: relative;
        }

        .main {
            margin-left: 0;
            width: 100%;
        }

        .navbar-nav {
            width: 100%;
            text-align: center;
        }

        .navbar-toggler {
            margin-right: 0;
        }

        .table th, .table td {
            font-size: 12px;
        }

        .accept-btn, .reject-btn {
            display: inline-block;
            width: auto;
            margin-bottom: 5px;
        }
    }

    /* Button Hover Animation */
    @keyframes buttonHover {
        from {
            transform: scale(1);
        }
        to {
            transform: scale(1.1);
        }
    }

    /* Accept Button Styles */
    .accept-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        text-decoration: none;
    }

    /* Reject Button Styles */
    .reject-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        text-decoration: none;
    }

    /* Button Hover Animation on Hover */
    .accept-btn:hover, .reject-btn:hover {
        animation: buttonHover 0.3s ease-in-out;
        text-decoration: none;
        background-color: darken( #28a745, 10% );
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
            <center><h2>Customer's Order</h2></center>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Details Order</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                // Display data in the table
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['items_info'] . "</td>";
                                        echo "<td>RM " . $row['total_price'] . "</td>";
                                        echo "<td>" . $row['order_date'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";

                                        // Accept Button with Confirmation Dialog
                                        echo '<td><a href="#" onclick="confirmAction(\'order_accept.php\', ' . $restaurant_id . ', ' . $row['user_id'] . ', \'' . $row['items_info'] . '\', ' . $row['total_price'] . ')" class="accept-btn">Accept</a></td>';

                                        // Reject Button with Confirmation Dialog
                                        echo '<td><a href="#" onclick="confirmAction(\'order_reject.php\', ' . $restaurant_id . ', ' . $row['user_id'] . ', \'' . $row['items_info'] . '\', ' . $row['total_price'] . ')" class="reject-btn">Reject</a></td>';

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No Order Yet</td></tr>";
                                }
                                ?>

<script>
    function confirmAction(actionUrl, restaurantId, userId, itemsInfo, totalAmount) {
        var confirmationMessage = "Are you sure you want to " + (actionUrl.includes('accept') ? "accept" : "reject") + " this order?";
        var confirmAction = confirm(confirmationMessage);

        if (confirmAction) {
            // If user clicks OK in the confirmation dialog, redirect to the specified action page
            window.location.href = actionUrl + '?restaurant_id=' + restaurantId + '&user_id=' + userId + '&details_order=' + itemsInfo + '&total_amount=' + totalAmount;
        } else {
            // If user clicks Cancel, do nothing
        }
    }
</script>


                    </tbody>
                </table>
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

<?php
// Close the database connection
$conn->close();
?>
