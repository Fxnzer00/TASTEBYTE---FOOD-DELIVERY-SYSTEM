<?php

// update_profile.php
// update_profile.php

session_start();

include 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo json_encode($row);
} else {
  echo "No user found with the given user_id";
}

$conn->close();


?>