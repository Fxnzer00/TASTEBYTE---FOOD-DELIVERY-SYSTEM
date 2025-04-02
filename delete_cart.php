<?php

include 'config.php';

// Assuming $cart_id is obtained from the URL parameters or user input
$cart_id = $_GET['cart_id'];

// Prepare the SQL query with a placeholder
$sql = "DELETE FROM cart WHERE cart_id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bind_param('i', $cart_id); // 'i' represents the data type (integer)

// Execute the query
$result_delete = $stmt->execute();

if ($result_delete) {
    // Redirect back to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    // Handle error, if necessary
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
