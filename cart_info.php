<?php

include('config.php');

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Specify the user_id for which you want to fetch data
$user_id_to_fetch = $user_id;

$query = "
SELECT
    m.image_file AS image,
    m.name AS item_name,
    m.price AS item_price,
    c.quantity,
    c.totalcost,
    c.cart_id
FROM
    cart c
JOIN
    menu_items m ON c.item_id = m.item_id
WHERE
    c.user_id = $user_id_to_fetch
    AND c.status = 'IN CART';
";


$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch data and store it in an array
    $cartData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cartData[] = $row;
    }

    // Calculate total cost
    $totalCost = 0;
    foreach ($cartData as $row) {
        $totalCost += $row['totalcost'];
    }

    // Release the result set
    mysqli_free_result($result);
} else {
    // Handle the query error
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
$conn->close();

?>

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-c4IoBUHfw4eNTI5yjSIAj9riP1i6brD0Cz7mW7KWS8UZbTMqGIJDIz66FYl2CQ3d" crossorigin="anonymous">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
<style>
    .modal-content {
        max-height: 500px; /* Set the maximum height for the modal content */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    .delete-btn {
        background-color: #d9534f;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .delete-btn i {
        margin-right: 5px;
    }

    .checkout-button {
    display: block;
    margin: 30px 0 90px 0; /* Adjust top, right, bottom, and left margins */
    padding: 12px 24px;
    font-size: 18px; /* Increased font size */
    background: linear-gradient(to right, #2ecc71, #3498db);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    float: right; /* Align the button to the right */

    /* Animation */
    animation: pulse 1.5s infinite;
}

/* Keyframes for the 'pulse' animation */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Hover effect to darken the background color on hover */
.checkout-button:hover {
    background-color: #45a049;
}



</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts.js" defer></script>

<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2><center>Cart</center></h2>
        <table id="cartTable" class="product-table">
            <thead>
              <!--  <tr>  
                    <th></th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                </tr> -->
            </thead>
            <tbody>
                <?php
                foreach ($cartData as $row) {
                    echo "<tr>";
                    echo '<td><a href="delete_cart.php?cart_id=' . $row['cart_id'] . '" class="delete-btn"><button class="delete-btn"><i class="fas fa-trash-alt"></i>Delete</button></a></td>';
                    echo "<td><img src='ADMIN/{$row['image']}'></td>";
                    echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">{$row['item_name']}</td>";
                   echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">{$row['item_price']}</td>";
                    echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">{$row['quantity']}</td>";
                    echo "<td style=\"font-size: 20px; font-family: 'Montserrat', sans-serif;\">{$row['totalcost']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            <?php
            // Check if there are items in the cart
            if (!empty($cartData)) {
                // If there are items, display the cart table and checkout button
                echo '<table id="cartTable" class="product-table">';
                // ... (previous code for displaying table rows)

                echo '<div style="text-align: center; margin-top: 10px;">';
                echo "<h2 style=\"text-align: right; font-size: 25px; font-family: 'Montserrat', sans-serif;\">Total: RM $totalCost</h2>";
                echo '<button id="checkoutBtn" class="checkout-button">Checkout</button>';
                echo '</div>';
            } else {
                // If there are no items, display a message
                echo '<p><center>No items in the cart. Add to cart now!</center></p>';
            }
            ?>

        </table>
        

    </div>
</div>



<script>
    // Get the button element by its ID
    var checkoutBtn = document.getElementById('checkoutBtn');

    // Add a click event listener to the button
    checkoutBtn.addEventListener('click', function() {
        // Redirect to checkout.php with the user_id as a query parameter
        window.location.href = 'checkout.php?user_id=<?php echo $user_id_to_fetch; ?>';
    });
</script>