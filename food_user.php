<?php
session_start();

include('config.php');

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];

// Function to fetch search results from the database
function fetchSearchResults($conn, $search_query)
{
    $search_query = '%' . mysqli_real_escape_string($conn, $search_query) . '%';

    $query = "SELECT * FROM restaurants WHERE name LIKE ? OR address LIKE ?";
    
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $search_query, $search_query);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the results
    $result = mysqli_stmt_get_result($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Fetch and return the results as an array
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Check if a search query is provided
if (isset($_GET['query'])) {
    $searchResults = fetchSearchResults($conn, $_GET['query']);
} else {
    // Query to retrieve information from the restaurants table
    $query = "SELECT * FROM restaurants";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Fetch all results
    $searchResults = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">

    <title>Food</title>
</head>
<body>
    <?php include 'header_page.php'; ?>

    <section class="main-content">
        <h2>Our Favourite's Restaurant</h2>

        <div class="search-box" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
            <form method="get" action="food_user.php">
                <input name="query" type="text" class="search-input" style="width: 700px; padding: 10px; font-size: 16px; border: 2px solid #333; border-radius: 5px; transition: width 0.3s ease-in-out;" 
                       placeholder="Search your restaurant name and location" onfocus="this.style.width='700px'" onblur="this.style.width='500px'">
                <button type="submit" style="display: none;">Search</button>
            </form>
        </div><br>

        <table class="product-table" style="background-color: white;">
            <tbody>
                <?php
                if (empty($searchResults)) {
                    echo '<tr><td colspan="5">No restaurants found.</td></tr>';
                } else {
                    foreach ($searchResults as $restaurant) {
                        echo '<tr class="product">';
                        echo '<td><img src="ADMIN/' . $restaurant['res_image'] . '" alt="Product ' . $restaurant['name'] . '"></td>';
                        echo '<td style="font-size: 20px; font-family: \'Montserrat\', sans-serif;">' . $restaurant['name'] . '</td>';
                        echo '<td style="font-size: 20px; font-family: \'Montserrat\', sans-serif;">' . $restaurant['address'] . '</td>';
                        echo '<td style="font-size: 20px; font-family: \'Montserrat\', sans-serif;">' . $restaurant['description'] . '</td>';
                        echo '<td><a href="menu_restaurant.php?restaurant_id=' . $restaurant['restaurant_id'] . '" class="add-to-cart" style="font-size: 20px; font-family: \'Montserrat\', sans-serif;">View Menu</a></td>';
                        echo '</tr>';
                    } 
                }
                ?>
            </tbody>
        </table>
    </section>

    <?php include 'cart_info.php'; ?>

    <footer style="background: linear-gradient(to right, #2ecc71, #3498db);">
        <p> © 2024 TASTEBYTE MY, ALL RIGHTS RESERVED.</p>
    </footer>
</body>
</html>
