

<?php
session_start();
include 'config.php'; // Your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menuId = $_POST["menuId"];
    $itemName = $_POST["itemName"];
    $itemPrice = $_POST["itemPrice"];
    $itemDescription = $_POST["itemDescription"];
    $existingImage = $_POST["existingImage"];
    $status = $_POST["availability"];
    $menu_visible="1";

    // Check if a new image file is uploaded
    if (isset($_FILES["imageFile"]) && $_FILES["imageFile"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "menu-images/"; // Your upload directory
        $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
                // Update the image_file path in your database
                $sql = "UPDATE menu_items SET image_file=? WHERE item_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $target_file, $menuId);
                $stmt->execute();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Update the other fields in your database
$sql = "UPDATE menu_items SET name=?, price=?, description=?, availability_status=?, menu_visible=? WHERE item_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsssi", $itemName, $itemPrice, $itemDescription, $status, $menu_visible ,$menuId);
    $stmt->execute();

    // Redirect to your menu page or display a success message
    header("Location: update_menu.php");
    exit();
}
?>
