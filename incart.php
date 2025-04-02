<?php

   include('config.php');

                // Query to count rows in the cart table for the given user and status
                $sql1 = "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = $user_id AND status = 'IN CART'";
                $result1 = $conn->query($sql1);

                if ($result1) {
                    $row1 = $result1->fetch_assoc();
                    $cart_count = $row1['cart_count'];

                    // Display the count in your HTML
                    echo $cart_count;
                } else {
                    echo "Error: " . $conn->error;
                }

                // Close the database connection
                $conn->close();
?>

