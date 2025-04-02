<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<?php
include('config.php');

// Check if restaurant_id is set in the URL
if (isset($_GET['restaurant_id'])) {
    $restaurant_id = $_GET['restaurant_id'];

    // Fetch menu items based on the restaurant_id
    $sql = "SELECT * FROM menu_items WHERE restaurant_id = $restaurant_id AND menu_visible='1' AND (availability_status='Available' OR availability_status='Low Stock')";
    $result = $conn->query($sql);
    // Do not close the database connection here
}
?>

<?php
include 'config.php';

// Check if the form is submitted
if (isset($_POST['add_to_cart'])) {
    $restaurant_id = intval($_POST['restaurant_id']);
    $item_id = intval($_POST['item_id']);
    $quantity = intval($_POST['quantity']);

    // Fetch the price from the menu_items table based on item_id
    $priceQuery = "SELECT price FROM menu_items WHERE item_id = ?";
    $priceStmt = $conn->prepare($priceQuery);
    $priceStmt->bind_param("i", $item_id);
    $priceStmt->execute();
    $priceResult = $priceStmt->get_result();

    if ($priceResult->num_rows > 0) {
        $row = $priceResult->fetch_assoc();
        $price = floatval($row['price']);
        $totalcost = $quantity * $price; // Calculate total cost based on quantity and price
        $status = "IN CART";

        // Prepare the SQL query to insert the item into the cart using prepared statements
        $insertQuery = "INSERT INTO cart (user_id, restaurant_id, item_id, quantity, totalcost, status) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("iiiids", $user_id, $restaurant_id, $item_id, $quantity, $totalcost, $status);
        
        // Execute the query
        if ($insertStmt->execute()) {
            echo "Item added to cart successfully.";
            header("Location: menu_restaurant.php?restaurant_id=" . $restaurant_id);
            exit();
        } else {
            echo "Error adding item to cart: " . $insertStmt->error;
        }
    } else {
        echo "Error fetching item price: " . $priceStmt->error;
    }

    // Close the prepared statements
    $priceStmt->close();
    $insertStmt->close();
}

// Close the database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <title>Menu</title>

   
</head>
<body>
    
    <?php include 'header_page.php'; ?>

    <section class="main-content">
        <h2>Our Menu</h2>

<div class="product-list">
    <table class="product-table" style="background-color: white;">
        <thead>
            <tr>
                <th>Food Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


                    <?php
                    if (isset($result) && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<form action='menu_restaurant.php' method='post'>";
                            echo "<tr class='product'>";
                            echo "<td><img src='ADMIN/" . $row['image_file'] . "' alt='" . $row['name'] . "'></td>";
                            echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">" . $row['name'] . "</td>";
                            echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">" . $row['description'] . "</td>";
                            echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">RM " . $row['price'] . "</td>";
                            
                            // Check availability status and set color accordingly
                            if ($row['availability_status'] == "Available") {
                                echo "<td style='font-size: 20px; font-family: \"Montserrat\", sans-serif; color: green;'>" . $row['availability_status'] . "</td>";
                            } elseif ($row['availability_status'] == "Low Stock") {
                                echo "<td style='font-size: 20px; font-family: \"Montserrat\", sans-serif; color: red;'>" . $row['availability_status'] . "</td>";
                            } else {
                                echo "<td style='font-size: 20px; font-family: \"Montserrat\", sans-serif;'>" . $row['availability_status'] . "</td>";
                            }

                            echo "<td>";
                            echo "<div class='number'>";
                            echo "<span class='minuss' style='cursor: pointer; color: red; font-size: 20px;'>-</span>";
                            echo "<input type='text' value='0' name='quantity' id='quantity-input-" . $row['item_id'] . "'>";

                            echo "<span class='pluss' style='cursor: pointer; color: green; font-size: 20px;'>+</span>";
                            echo "</div>";
                            echo "</td>";

                            echo '<td><input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
                            echo '<input type="hidden" name="restaurant_id" value="' . $row['restaurant_id'] . '">';
                            echo "<button type='submit' name='add_to_cart' class='add-to-cart' style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">Add to Cart</button>";

                            echo "</tr>";
                            echo "</form>";
                        }
                    } else {
                        echo "No menu items found for this restaurant.";
                    }
                    ?>



            <!-- Add more food items as needed -->
        </tbody>
    </table>
</div>

    </section>
       <?php

       include 'cart_info.php';

        ?>

    <footer style="background: linear-gradient(to right, #2ecc71, #3498db);">
        <p> © 2024 TASTEBYTE MY, ALL RIGHTS RESERVED.</p>
    </footer>

</body>
</html>

 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts.js" defer></script>
<script>
$(document).ready(function() {
    $('.minuss').click(function () {
        var $input = $(this).siblings('input[type="text"]');
        var count = parseInt($input.val()) - 1;
        count = count < 0 ? 0 : count; // Ensure count doesn't go below 0
        $input.val(count);
        $input.change();
        return false;
    });

    $('.pluss').click(function () {
        var $input = $(this).siblings('input[type="text"]');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

    // Delegate event handling for form submission
    $(document).on('submit', 'form', function(event) {
        var $form = $(this);
        var quantity = parseInt($form.find('input[type="text"]').val());
        if (quantity === 0) {
            alert("Can't add 0 item to cart");
            event.preventDefault(); // Prevent form submission
        }
    });
});


</script>



