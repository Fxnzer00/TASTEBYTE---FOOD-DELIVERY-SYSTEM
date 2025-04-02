<?php
// Start or resume a session
include 'upload.php';
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

        /* Responsive form design */
        @media (max-width: 767px) {
            .main {
                margin-left: 0;
            }
        }


         /* Image preview */
        .image-preview {
            width: 100%;
            height: 200px;
            border: 1px solid #ccc;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            margin-bottom: 20px;
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
            <div class="container">
                <h2 class="text-center mt-5">Upload Your Restaurant's Food</h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name of Food</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of food">
                    </div>
                    <div class="form-group">
                        <label for="description">Description of Food</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description of food"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (RM)</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability Status</label>
                        <select class="form-control" id="availability" name="availability">
                            <option value="Available">Available</option>
                            <option value="Not_Available">Not Available</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Food Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        <div class="image-preview" id="image-preview"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
</main>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Add the following script for submenu -->
    <script>
 $(document).ready(function(){
    $(".sidebar a").on("shown.bs.dropdown", function(){
        $(this).find(".submenu").show();
    }).on("hidden.bs.dropdown", function(){
        $(this).find(".submenu").hide();
    });
});
    </script>
</body>
</html>
