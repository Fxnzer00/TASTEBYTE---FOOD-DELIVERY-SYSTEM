

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

// Fetch the restaurant_id associated with the user
$sql = "SELECT restaurant_id FROM menu_items WHERE restaurant_id = $user_id";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $restaurant_id = $row['restaurant_id'];

    // Fetch menu items based on restaurant_id
    $sql_menu = "SELECT * FROM menu_items WHERE restaurant_id = $restaurant_id AND menu_visible = '1'";
    $result_menu = $conn->query($sql_menu);

    // Check if the query was successful
    if (!$result_menu) {
        die("Error fetching data: " . $conn->error);
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to a page where restaurant_id is specified (you may customize this part)
    header("Location: showall_menu.php");
    exit();
}
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
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .main {
            display: flex;
            flex: 1;
        }

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

        .main-content {
            margin-left: 200px;
            flex: 1;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive > .table {
            margin-bottom: 0;
        }

        .table-responsive > .table > thead > tr > th,
        .table-responsive > .table > tbody > tr > th,
        .table-responsive > .table > tfoot > tr > th,
        .table-responsive > .table > thead > tr > td,
        .table-responsive > .table > tbody > tr > td,
        .table-responsive > .table > tfoot > tr > td {
            white-space: nowrap;
        }

        .table-responsive > .table-bordered {
            border: 0;
        }

        .table-responsive > .table-bordered > thead > tr > th:first-child,
        .table-responsive > .table-bordered > tbody > tr > th:first-child,
        .table-responsive > .table-bordered > tfoot > tr > th:first-child,
        .table-responsive > .table-bordered > thead > tr > td:first-child,
        .table-responsive > .table-bordered > tbody > tr > td:first-child,
        .table-responsive > .table-bordered > tfoot > tr > td:first-child {
            border-left: 0;
        }

        .table-responsive > .table-bordered > thead > tr > th:last-child,
        .table-responsive > .table-bordered > tbody > tr > th:last-child,
        .table-responsive > .table-bordered > tfoot > tr > th:last-child,
        .table-responsive > .table-bordered > thead > tr > td:last-child,
        .table-responsive > .table-bordered > tbody > tr > td:last-child,
        .table-responsive > .table-bordered > tfoot > tr > td:last-child {
            border-right: 0;
        }

        .table-responsive > .table-bordered > tbody > tr:last-child > th,
        .table-responsive > .table-bordered > tfoot > tr:last-child > th,
        .table-responsive > .table-bordered > tbody > tr:last-child > td,
        .table-responsive > .table-bordered > tfoot > tr:last-child > td {
            border-bottom: 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Popup Styles */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        width: 100%;
        text-align: center;
        position: relative;
    }

    .close-popup {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    /* Form Styles */
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        margin-top: 10px;
    }

    input,
    textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
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
        <div class="main-content">
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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image_File</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row_menu = $result_menu->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a target='_blank' href='" . $row_menu['image_file'] . "'><img width='100px' height='100px' src='" . $row_menu['image_file'] . "'></a></td>";
                            echo "<td>{$row_menu['name']}</td>";
                            echo "<td>{$row_menu['price']}</td>";
                            echo "<td>{$row_menu['availability_status']}</td>";
                            echo "<td>{$row_menu['description']}</td>";
                            echo "<td>
                                        <button type='button' class='btn btn-primary' onclick='openPopup(" . json_encode($row_menu) . ")'>Update</button>
                                      </td>";
                            echo "</tr>";
                        }
                        ?>


                </tbody>
            </table>
        </div>
    </main>
        </div>
    </div>


 <div class="popup" id="updatePopup">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <h2>Update Menu Item</h2>
        <!-- Your update form goes here -->
        <form action="update_pros.php" method="post" enctype="multipart/form-data">
    <!-- Image Upload Field -->
    <label for="imageFile">Choose New Image</label>
     <input type="file" id="imageFile" name="imageFile" accept="image/*">
    <!-- Display the existing image -->
    <label for="imageFile">Origin Image</label>
    <img id="previewImage" src="<?php echo $row_menu['image_file']; ?>" alt="Preview Image" style="max-width: 50px; height: 50px">

<!-- Add a hidden input for the image file path -->
    <input type="hidden" id="existingImage" name="existingImage" value="<?php echo $row_menu['image_file']; ?>">


    <!-- Name Field -->
    <label for="itemName">Name:</label>
    <input type="text" id="itemName" name="itemName" required>

    <!-- Price Field -->
    <label for="itemPrice">Price:</label>
    <input type="number" id="itemPrice" name="itemPrice" step="0.01" required>


    <!-- Description Field -->
    <label for="itemDescription">Description:</label>
    <textarea id="itemDescription" name="itemDescription" rows="1" cols="50" required></textarea>
    <!-- Add this to your form -->
    <input type="hidden" id="menuId" name="menuId">

     <label for="availability">Availability Status</label>
    <select id="availability" name="availability">
    <option value="Available">Available</option>
    <option value="Low Stock">Low Stock</option>
    <option value="Not Available">Not Available</option>

    </select>
    <br>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

    </div>
</div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Add the following script for submenu -->
<!-- Update the JavaScript function to handle displaying the existing image -->
<script>
function openPopup(rowData) {
    document.getElementById('updatePopup').style.display = 'flex';

    // Display the existing image
    document.getElementById('previewImage').src = rowData.image_file;

    // Populate the form fields with data from the selected row
    document.getElementById('itemName').value = rowData.name;
    document.getElementById('itemPrice').value = rowData.price;
    document.getElementById('itemDescription').value = rowData.description;
    document.getElementById('availability').value = rowData.availability_status;

    // Set the existing image path in a hidden field
    document.getElementById('existingImage').value = rowData.image_file;

    // You may also need to set the menuId if it's available in your data
    document.getElementById('menuId').value = rowData.item_id; // Replace 'id' with the actual field name from your database
}

function closePopup() {
        document.getElementById('updatePopup').style.display = 'none';
    }

</script>


</body>
</html>



