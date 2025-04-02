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
        }

        main {
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeIn 1s ease-in-out;
        }

        form {
            animation: slideIn 1s ease-in-out;
        }

        /* Input animation */
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #6cb2eb;
        }

        /* Button styles */
        button {
            background-color: #6cb2eb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4a8fe2;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
            <main>
    <div class="container mt-4">
        <h2>Update Restaurant's Profile</h2>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
        <!-- Add this hidden input field to store user_id -->
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <div class="form-group">
                <label for="imageFile">Choose New Restaurant Image</label>
                <input type="file" id="imageFile" name="imageFile" accept="image/*">

                <!-- Display the existing image -->
                <label for="imageFile">Origin Image</label>
                <img id="previewImage" src="<?php echo $image_file; ?>" alt="Preview Image" style="max-width: 100%; height: auto;">

                <!-- Add a hidden input for the image file path -->
                <input type="hidden" id="existingImage" name="existingImage" value="<?php echo $image_file; ?>">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <!--<input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>-->
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="name">Restaurant's Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description Restaurant:</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter a short description about yourself"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="address">Address Restaurant:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $address; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $phone; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</main>

        </main>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Add the following script for submenu -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formGroups = document.querySelectorAll(".form-group");

        formGroups.forEach((formGroup) => {
            const input = formGroup.querySelector("input, textarea");

            input.addEventListener("focus", function () {
                formGroup.classList.add("active");
            });

            input.addEventListener("blur", function () {
                if (!input.value.trim()) {
                    formGroup.classList.remove("active");
                }
            });
        });
    });
</script>
</body>
</html>
