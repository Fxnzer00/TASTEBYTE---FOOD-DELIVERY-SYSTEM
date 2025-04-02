

<?php
session_start();

include('config.php');

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Check if the form is submitted
if (isset($_POST['add_to_cart'])) {
    // Assuming you have already sanitized and validated the input data
    $restaurant_id = intval($_POST['restaurant_id']);
    $item_id = intval($_POST['item_id']);
    $quantity = intval($_POST['quantity']);

    // Fetch the price from the menu_items table based on item_id
    $priceQuery = "SELECT price FROM menu_items WHERE item_id = $item_id";
    $priceResult = $conn->query($priceQuery);

    if ($priceResult->num_rows > 0) {
        $row = $priceResult->fetch_assoc();
        $price = floatval($row['price']);
        $totalcost = $quantity * $price; // Calculate total cost based on quantity and price

        // Prepare the SQL query to insert the item into the cart
        $insertQuery = "INSERT INTO cart (user_id, restaurant_id, item_id, quantity, totalcost) VALUES ($user_id, $restaurant_id, $item_id, $quantity, $totalcost)";

        // Execute the query
        if ($conn->query($insertQuery) === TRUE) {
            echo "Item added to cart successfully.";
            //header("Location: menu_restaurant.php");
            //exit();
        } else {
            echo "Error adding item to cart: " . $conn->error;
        }
    } else {
        echo "Error fetching item price: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
