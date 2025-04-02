<?php
// Start or resume a session
session_start();
include 'config.php';

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$query = "SELECT * FROM restaurants WHERE restaurant_id = $user_id";
$result = $conn->query($query);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $restaurantData = $result->fetch_assoc();

    // Extract data for use in the HTML form
    $name = $restaurantData['name'];
    $description = $restaurantData['description'];
    $address = $restaurantData['address'];
    $email = $restaurantData['email'];
    $phone = $restaurantData['phone_number'];
    $image_file = $restaurantData['res_image'];

} else {
    // Handle the case where no data is found for the given restaurant_id
    echo "No data found for the specified restaurant_id.";
}

// Close the database connection
$conn->close();
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
        transition: margin-left 0.3s, opacity 0.3s; /* Add transition for smooth animation */
        opacity: 1; /* Initially set opacity to 1 */
    }

    .main.fade-out {
        opacity: 0; /* Set opacity to 0 when fading out */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .main.fade-in {
        animation: fadeIn 0.5s ease-out; /* Adjust the animation duration and easing as needed */
    }

    @media screen and (max-width: 600px) {
        /* Adjust margin for smaller screens */
        .main {
            margin-left: 0;
        }

        /* Hide the sidebar on small screens */
        .sidebar {
            display: none;
        }

        /* Show the sidebar when the menu icon is clicked */
        .navbar-toggler-icon {
            display: block;
        }

        .navbar-collapse {
            display: none;
            position: absolute;
            background-color: #343a40;
            width: 100%;
            z-index: 1;
        }

        .navbar-nav {
            display: block;
            margin: 0;
            padding: 0;
        }

        .navbar-nav a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .navbar-toggler {
            display: block;
        }

        .main.active {
            margin-left: 0;
        }

        .main.active .sidebar {
            display: block;
        }

        .main.fade-in,
        .main.fade-out {
            animation: none; /* Disable animation on small screens */
        }
    }
</style>

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
        <div id="content" class="main">
                <main>
                <div class="container mt-4">
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo $image_file; ?>" alt="Restaurant Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h4>Restaurant's Name: <?php echo $name; ?></h4>
                            <p>Manager's Name: <?php echo $username; ?></p>
                            <p>Description: <?php echo $description; ?></p>
                            <p>Address: <?php echo $address; ?></p>
                            <p>Email: <?php echo $email; ?></p>
                            <p>Phone: <?php echo $phone; ?></p>
                        </div>
                    </div>
                </div>
            </main>

            </div>

    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Add the following script for submenu -->
   <script>
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        const content = document.getElementById('content');
        content.classList.toggle('active');
        content.classList.toggle('fade-in');
        content.classList.toggle('fade-out');
    });
</script>


</body>
</html>
