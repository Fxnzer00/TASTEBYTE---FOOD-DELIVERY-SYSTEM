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
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <img src="ADMIN/bg-images/slide3.jpg" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="ADMIN/bg-images/slide1.jpg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="ADMIN/bg-images/slide2.jpg" alt="Slide 3">
            </div>
        </div>
        <a href="food_user.php">
    <button class="submit-button" style="font-size: 20px; font-family: 'Montserrat', sans-serif;">Order Now</button></a>

    </div>

        
<br>
   
<center><h2>Top Favourite's Restaurants</h2></center>

 <?php
// Database configuration
include 'config.php';

// Query to find the most common restaurant_id in order_condition
$query7 = "SELECT restaurant_id, COUNT(restaurant_id) AS count FROM order_condition GROUP BY restaurant_id ORDER BY count DESC LIMIT 1";

$result7 = $conn->query($query7);

if ($result7->num_rows > 0) {
    $row7 = $result7->fetch_assoc();
    $mostCommonRestaurantId = $row7["restaurant_id"];

    // Fetch information from restaurants table based on the most common restaurant_id
    $restaurantQuery = "SELECT r.name, r.address, r.res_image, r.restaurant_id 
                        FROM restaurants r
                        JOIN order_condition o ON r.restaurant_id = o.restaurant_id
                        WHERE o.restaurant_id = $mostCommonRestaurantId";
    $restaurantResult = $conn->query($restaurantQuery);

    if ($restaurantResult->num_rows > 0) {
        $restaurantRow = $restaurantResult->fetch_assoc();
        $restaurantName = $restaurantRow["name"];
        $restaurantAddress = $restaurantRow["address"];
        $restaurantImage = $restaurantRow["res_image"];
        $restaurantID = $restaurantRow["restaurant_id"];

        // Output the information in your HTML
        echo "<div style='overflow-x: auto;'>";
        echo "<table style='border-collapse: collapse; width: 80%; max-width: 600px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px; background-color: #fff; margin: 20px; margin: auto;'>";

        echo "<tbody>";
        echo "<tr style='background-color: white;'>";
        echo "<td style='padding: 15px; text-align: left;'><img src='ADMIN/$restaurantImage' alt='' style='width: 200px; height: 200px; object-fit: cover; border-radius: 50%;'></td>";
        echo "<td style='padding: 15px; text-align: left; font-size: 20px; font-family: \'Montserrat\', sans-serif;'>$restaurantName</td>";
        echo "<td style='padding: 15px; text-align: left; font-size: 20px; font-family: \'Montserrat\', sans-serif;'>$restaurantAddress</td>";
        echo "<td style='padding: 15px; text-align: left; font-size: 20px; font-family: \'Montserrat\', sans-serif;'>
          <button style='
            animation: moveAnimation 2s infinite;
            transform-origin: center;
            background: linear-gradient(to right, #2ecc71, #3498db);
            color: #ffffff; /* White text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
          '><a href='menu_restaurant.php?restaurant_id={$restaurantID}' style='color: #ffffff; text-decoration: none;'>View Menu</a></button></td>";

        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
}

// Close connection
$conn->close();
?>



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

<script>
  function autoSearch(query) {
    // Add your search logic here using the 'query' parameter
    console.log("Auto-searching for:", query);
    // You can replace the console.log with the actual search functionality.
  }
</script>



