<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup.php");
    exit();
}

$restaurant_id = $_GET['restaurant_id'];
$user_id = $_GET['user_id'];
$details_order = $_GET['details_order'];
$total_amount = $_GET['total_amount'];

$total=($total_amount*6)/100;
$totaltorefund=$total_amount+$total;

// Update the status in order_place table
$updateSql = "UPDATE order_place SET status = 'DONE DECIDE' WHERE restaurant_id = $restaurant_id AND user_id = $user_id";
$conn->query($updateSql);

// Insert into order_condition table
$insertSql = "INSERT INTO order_condition (restaurant_id, user_id, details_order, total_amount, status, sys_visible, order_accept_date) VALUES ($restaurant_id, $user_id, '$details_order', $total_amount, 'REJECT', '1', NOW())";
$conn->query($insertSql);

// Update wallet_balance for the user
$updateWalletSql = "UPDATE users SET wallet_balance = wallet_balance + $totaltorefund WHERE user_id = $user_id";
$conn->query($updateWalletSql);

$conn->close();

// Redirect back to the dashboard or wherever you want
header("Location: customer_order.php");
exit();
?>
