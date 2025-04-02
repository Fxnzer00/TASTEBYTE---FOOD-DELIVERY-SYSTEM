<?php
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['topup-amount'];

    // Update the users table by adding the new amount to the current value
    $update_query = "UPDATE users SET wallet_balance = wallet_balance + '$amount' WHERE user_id = '$user_id'";
    $result = $conn->query($update_query);

    // Check if the update was successful
    if ($result) {
        echo "Update successful!";
        
        // Redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
