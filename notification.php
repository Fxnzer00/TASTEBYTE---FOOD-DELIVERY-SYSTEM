<?php
// Include the database configuration
include 'config.php';


// SQL query to count rows with sys_visible = '1'
$sqlCount = "SELECT COUNT(*) as count1 FROM order_condition WHERE user_id = $user_id AND sys_visible = '1'";

// Perform the query
$resultCount = $conn->query($sqlCount);

// Check if the query was successful
if ($resultCount === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    // Fetch and display the count
    $rowCount = $resultCount->fetch_assoc();
    $count1 = $rowCount['count1'];

    echo $count1;

    // Free the result set
    $resultCount->free();
}

// Close the database connection
$conn->close();
?>
