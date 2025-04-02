<?php
include('config.php');

$user_id_to_fetch = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

// Fetch user details
$user_query = "SELECT * FROM users WHERE user_id = $user_id_to_fetch";
$user_result = $conn->query($user_query);

if ($user_result) {
    $user_data = $user_result->fetch_assoc();
} else {
    die("Error fetching user data: " . $conn->error);
}

// Fetch cart details
$cart_query = "SELECT cart.cart_id, cart.quantity, cart.totalcost, menu_items.name, menu_items.price, menu_items.restaurant_id
               FROM cart
               INNER JOIN menu_items ON cart.item_id = menu_items.item_id
               WHERE cart.user_id = $user_id_to_fetch AND cart.status = 'IN CART'";

$cart_result = $conn->query($cart_query);

if (!$cart_result) {
    die("Error fetching cart data: " . $conn->error);
}

$totalCost = 0;
$cartData = []; // Array to store cart data

while ($cart_row = $cart_result->fetch_assoc()) {
    $cartData[] = $cart_row; // Store cart data in an array
    $totalCost += $cart_row['totalcost']; // Calculate total cost
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      line-height: 1.5;
      color: #333;
      background-color: #f5f5f5;
    }

    .container {
      width: 50%;
      margin: 0 auto;
      padding: 1rem;
      background-color: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-container {
      max-width: 500px; /* Reduced maximum width */
      margin: 0 auto;
      padding: 1.5rem;
    }

    .form-container h2 {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 0.25rem;
      font-size: 1rem;
      line-height: 1.5;
    }

    .form-group textarea {
      height: 8rem;
    }

    .form-group select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 14 8'><polygon points='0,0 7,8 14,0'/></svg>");
      background-repeat: no-repeat;
      background-position: right 0.5rem center;
      background-size: 1rem;
      padding-right: 2rem;
    }

    .form-group .item-details,
    .price-details {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
    }

    .form-group .item-name,
    .item-price,
    .price {
      font-size: 1.1rem;
      font-weight: bold;
    }

    .form-group .item-quantity,
    .tax {
      font-size: 1.1rem;
      color: #666;
    }

    .form-group .price {
      font-size: 1.3rem;
      font-weight: bold;
    }

    #delivery {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #666;
    }

    #delivery::before {
      content: '*';
      color: #f00;
      margin-right: 0.5rem;
    }

    #delivery-options {
      margin-top: 1rem;
    }

    #delivery-options option[value="standard"] {
      background-color: #f5f5f5;
    }

    #delivery-options option[value="express"] {
      background-color: #ffbdbd;
    }

    #delivery-options option:checked {
      background-color: #ffe6e6;
    }

    #delivery-options option:checked::before {
      content: '✓';
    }

    /* Place Order Button Styles */
    .place-order-btn {
      display: block;
      width: 100%;
      padding: 1rem;
      background: linear-gradient(to right, #2ecc71, #3498db);
      color: white;
      text-align: center;
      text-decoration: none;
      font-size: 1.2rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .place-order-btn:hover {
      background-color: #45a049;
          }

          /* Table Styles */
      table {
        width: 100%;
        margin-top: 1rem;
        border-collapse: collapse;
      }

      th, td {
        padding: 0.5rem;
        border: 1px solid #ccc;
        font-size: 1rem;
        line-height: 1.5;
      }

      th {
        font-weight: bold;
        text-align: left;
        background-color: #f5f5f5;
      }

      /* You can adjust the background-color as needed for your design */

  </style>
</head>
<body>
  <div class="container">
    <div class="form-container">

        <h2>CHECKOUT</h2>
        <!-- Shipping Details -->
        <div class="form-group">
          <label for="country">DELIVERY FOOD COUNTRY</label>
          <input type="text" id="country" value="Malaysia" disabled>
        </div>
      <form action="process_order.php" method="post">
                <div class="form-group">
          <label for="name">NAME</label>
          <input type="text" id="name" value="<?php echo $user_data['full_name']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="email">EMAIL ADDRESS</label>
          <input type="email" id="email" value="<?php echo $user_data['email']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="address">DELIVERY ADDRESS</label>
          <textarea id="address" disabled><?php echo $user_data['address']; ?></textarea>
        </div>

        <div class="form-group">
          <label for="phone">PHONE NUMBER</label>
          <input type="tel" id="phone" value="<?php echo $user_data['phone_number']; ?>" disabled>
        </div>

        <!-- Item Details -->
        <div class="form-group">
          <label for="items">FOOD ITEM</label>
          <table>
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cartData as $cart_row) : ?>
                <tr>
                  <td><?php echo $cart_row['name']; ?></td>
                  <td><?php echo $cart_row['quantity']; ?></td>
                  <td>RM <?php echo number_format($cart_row['price'], 2); ?></td>
                  <input type="hidden" name="cart_id[]" value="<?php echo $cart_row['cart_id']; ?>">
                  <input type="hidden" name="restaurant_id[]" value="<?php echo $cart_row['restaurant_id']; ?>">
                  <input type="hidden" name="item_name[]" value="<?php echo $cart_row['name']; ?>">
                  <input type="hidden" name="quantity[]" value="<?php echo $cart_row['quantity']; ?>">
                  <input type="hidden" name="price[]" value="<?php echo number_format($cart_row['price'], 2); ?>">
                  <input type="hidden" name="name" value="<?php echo $user_data['full_name']; ?>">
                  <input type="hidden" name="email" value="<?php echo $user_data['email']; ?>">
                  <input type="hidden" name="address" value="<?php echo $user_data['address']; ?>">
                  <input type="hidden" name="phone" value="<?php echo $user_data['phone_number']; ?>">

                  <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>">
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?php

        $totaltax = ($totalCost*6)/100;
        $totalaftertax = $totalCost + $totaltax + 4.50;

        ?>

        <!-- Subtotal -->
        <div class="form-group">
          
          <div class="price-details">
            <label for="subtotal">SUBTOTAL</label>
            <div class="price">RM <?php echo $totalCost; ?></div>
            

          </div>
        </div>

        <!-- Total to Pay -->
        <div class="form-group">
          <div class="tax" style="text-align: right;">RM <?php echo $totaltax; ?> (6% Service Tax)</div>
          <div class="tax" style="text-align: right;">RM 4.50 (Delivery Charge)</div>
          <div class="price-details">
            <label for="total">TOTAL TO PAY</label>
            <div class="price">RM <?php echo $totalaftertax; ?></div>
          </div>
        </div>

        

        <!-- Place Order Button -->
        <button class="place-order-btn" type="submit">Place Order</button>
      </form>
    </div>
  </div>
</body>
</html>
