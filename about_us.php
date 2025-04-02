<?php
// Start or resume a session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <title>Home</title>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts.js" defer></script>




</head>
<body>
        <?php include 'header_page.php'; ?>

<section class="main-content">
    <div style="max-width: 800px; margin: 0 auto; padding: 20px; text-align: justify;">

        <h2 style="color: #3498db;">About Us</h2>
        <p style="line-height: 1.5;">Welcome to TASTEBYTE, your ultimate destination for a delightful online food ordering experience. At TASTEBYTE, we strive to bring you the finest culinary delights from your favorite local restaurants, right to your doorstep.</p>

        <h3 style="color: #3498db;">Our Mission</h3>
        <p style="line-height: 1.5;">Our mission is to make your dining experience convenient, enjoyable, and memorable. We connect food lovers with the best restaurants in town, offering a diverse range of cuisines to satisfy every palate.</p>

        <h3 style="color: #3498db;">Why Choose TASTEBYTE?</h3>
        <p style="line-height: 1.5;">With a user-friendly interface, quick delivery, and a vast selection of restaurants, TASTEBYTE is the go-to platform for food enthusiasts. We prioritize customer satisfaction and aim to exceed your expectations with every order.</p>

        <h3 style="color: #3498db;">Contact Us</h3>
        <p style="line-height: 1.5;">If you have any questions, concerns, or feedback, feel free to reach out to our customer support team. We are here to assist you in making your TASTEBYTE experience exceptional.</p>
    </div>
</section>


        <?php
        include 'cart_info.php';
        ?>
<br><br><br><br><br><br>
    <footer style="background: linear-gradient(to right, #2ecc71, #3498db);">
        <p> © 2024 TASTEBYTE MY, ALL RIGHTS RESERVED.</p>
    </footer>


</body>
</html>
