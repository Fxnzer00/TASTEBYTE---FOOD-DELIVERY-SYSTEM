<?php


include 'config.php';


$sql2 = "SELECT wallet_balance, username FROM users WHERE user_id = $user_id";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();

    // Assign fetched data to variables
    $wallet_balance = $row2['wallet_balance'];
        echo $wallet_balance;

} else {
    echo "No user found with the given user_id";
}

$conn->close();


?>