<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the necessary keys exist in the $_POST array
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $cart_id = isset($_POST['cart_id']) ? $_POST['cart_id'] : [];
    $restaurant_ids = isset($_POST['restaurant_id']) ? $_POST['restaurant_id'] : [];
    $item_names = isset($_POST['item_name']) ? $_POST['item_name'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
    $prices = isset($_POST['price']) ? $_POST['price'] : [];

    // Calculate total price
    $total_price = 0;
    for ($i = 0; $i < count($prices); $i++) {
        $total_price += $prices[$i] * $quantities[$i];
    }

    // Service charge and delivery charge
    $service_charge_percentage = 0.06; // 6%
    $delivery_charge = 4.50;

    // Calculate total order amount including service charge and delivery charge
    $total_order_amount = $total_price * (1 + $service_charge_percentage) + $delivery_charge;

    // Check if wallet_balance is sufficient
    $stmtBalance = $conn->prepare("SELECT wallet_balance FROM users WHERE user_id = ?");
    $stmtBalance->bind_param("i", $user_id);
    $stmtBalance->execute();
    $stmtBalance->bind_result($wallet_balance);
    $stmtBalance->fetch();
    $stmtBalance->close();

    // Calculate new balance
    $new_balance = $wallet_balance - $total_order_amount;

    // Check if the balance is sufficient
    if ($new_balance >= -1) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO order_place (user_id, restaurant_id, name, address, email, phone, item_name, quantity, price, total_price, status, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        // Set the status outside the loop
        $status = "Pending";

        // Bind parameters and execute the statement for each row
        for ($i = 0; $i < count($restaurant_ids); $i++) {
            $stmt->bind_param("iisssissdds", $user_id, $restaurant_ids[$i], $name, $address, $email, $phone, $item_names[$i], $quantities[$i], $prices[$i], $total_price, $status);
            $stmt->execute();
        }

        // Update wallet_balance in users table
        $stmtUpdateBalance = $conn->prepare("UPDATE users SET wallet_balance = ? WHERE user_id = ?");
        $stmtUpdateBalance->bind_param("di", $new_balance, $user_id);
        $stmtUpdateBalance->execute();
        $stmtUpdateBalance->close();

        // Update cart status to "DONE ORDER" only when the order is placed successfully
        $stmtUpdateCartStatus = $conn->prepare("UPDATE cart SET status = 'DONE ORDER' WHERE cart_id = ?");
        for ($i = 0; $i < count($cart_id); $i++) {
            $stmtUpdateCartStatus->bind_param("i", $cart_id[$i]);
            $stmtUpdateCartStatus->execute();
        }
        $stmtUpdateCartStatus->close();

        // Display success message
        echo "Order placed successfully!";
        header("Location: success.php");
        exit();
    } else {
        // Display insufficient funds message
        echo "Insufficient funds. Order not placed.";
        header("Location: failed.php");
        exit();
    }

} else {
    // Display invalid request message
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
