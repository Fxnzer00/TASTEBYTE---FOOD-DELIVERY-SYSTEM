
<?php
include 'config.php';

// Check if the required parameters are set in the URL
if (isset($_GET['order_condition_id'], $_GET['restaurant_id'], $_GET['user_id'])) {
    
    // Retrieve values from the URL
    $order_condition_id = $_GET['order_condition_id'];
    $restaurant_id = $_GET['restaurant_id'];
    $user_id = $_GET['user_id'];

    // Perform database update query
    // Assuming you have a database connection established
    
    // Make sure to sanitize input to prevent SQL injection
    $order_condition_id = intval($order_condition_id);
    $restaurant_id = intval($restaurant_id);
    $user_id = intval($user_id);
    
    // Assuming your table is named "order_condition" and the field to update is "sys_visible"
    $updateQuery = "UPDATE order_condition SET sys_visible = '0' WHERE user_id = $user_id AND order_condition_id = $order_condition_id";

    // Execute the query
    // $conn is assumed to be your database connection variable
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
} else {
    // Handle the case where required parameters are not set
    echo "Missing required parameters in the URL.";
}
?>
