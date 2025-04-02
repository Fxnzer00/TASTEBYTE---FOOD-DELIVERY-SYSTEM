<?php
// Start or resume a session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup.php");
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "taste-byte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user information from the session
    $user_id = $_SESSION['user_id'];

    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $menu_visible = "1";

    // File upload handling
    $targetDir = "menu-images/";  // Specify your upload directory
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists and remove it
    if (file_exists($targetFile)) {
        unlink($targetFile); // Remove the existing file
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert menu item into the database
            $sql = "INSERT INTO menu_items (restaurant_id, name, description, price, availability_status, menu_visible, image_file) VALUES ('$user_id', '$name', '$description', '$price', '$availability', '$menu_visible', '$targetFile')";

            // Execute the query
            $conn->query($sql);

            // Redirect to a success page or back to the form page
            header("Location: add_menu.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
