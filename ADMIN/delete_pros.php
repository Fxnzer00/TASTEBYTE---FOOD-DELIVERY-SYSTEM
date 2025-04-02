<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: loginsignup.php");
        exit();
    }

    // Retrieve user information from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve item_id from the form submission
    $item_id = $_POST['item_id'];
    $menu_visible = "0";

    // Perform the delete query
    $sql_delete = "UPDATE menu_items SET menu_visible = '0' WHERE restaurant_id = $user_id AND item_id = $item_id";

    $result_delete = $conn->query($sql_delete);

    if ($result_delete) {
        // Redirect to the page after successful deletion
        header("Location: delete_menu.php");
        exit();
    } else {
        // Handle the error, you can customize this part
        die("Error deleting menu item: " . $conn->error);
    }
} else {
    // Redirect to an error page if accessed through GET or other methods
    header("Location: error.php");
    exit();
}
?>
