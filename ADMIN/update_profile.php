
<?php
session_start();
include 'config.php'; // Your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the form, including user_id
    $userId = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Fetch existing image file path
    $existingImage = $_POST["existingImage"];

    // Check if a new password is provided
    $password = empty($password) ? $existingImage : password_hash($password, PASSWORD_DEFAULT);

    // Update the database using prepared statements
    $sqlUpdateProfile = "UPDATE restaurants
                    SET username=?, password=?, name=?, description=?, address=?, email=?, phone_number=?
                    WHERE restaurant_id=?";

    $stmtUpdateProfile = $conn->prepare($sqlUpdateProfile);
    $stmtUpdateProfile->bind_param("sssssssi", $username, $password, $name, $description, $address, $email, $phone, $userId);
    $stmtUpdateProfile->execute();

    // Check if a new image file is uploaded
    if (isset($_FILES["imageFile"]) && $_FILES["imageFile"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "restaurant-images/"; // Your upload directory
        $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
                // Update the image_file path in your database
                $sqlUpdateImage = "UPDATE restaurants SET res_image=? WHERE restaurant_id=?";
                $stmtUpdateImage = $conn->prepare($sqlUpdateImage);
                $stmtUpdateImage->bind_param("si", $target_file, $userId);
                $stmtUpdateImage->execute();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Redirect to a success page or display a success message
    header("Location: profile.php");
    exit();
}

$conn->close();
?>
