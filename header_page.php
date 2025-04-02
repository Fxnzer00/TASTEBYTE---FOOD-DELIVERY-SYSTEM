  <?php

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: loginsignup_user.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

//

?>


<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezrVg1RjP7DQ/AohtL6/M/WTweTjq0zfrU8DrtP9V7Y/1ZtUvq8ViPTZZEziFerzs" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts.js" defer></script>

<header style="background: linear-gradient(to right, #2ecc71, #3498db);">
        <h1 style="font-size: 50px;">ＴＡＳＴＥＢＹＴＥ🛵</h1>
        <nav>
            <ul>
                <li><a href="profile_user.php" style="font-size: 22px; font-family: \"Montserrat\", sans-serif;">Welcome, <?php echo $username; ?></a></li>
                <li><a href="index_user.php" style="font-size: 22px; font-family: \"Montserrat\", sans-serif;">Home </a></li>
                <li><a href="food_user.php" style="font-size: 22px; font-family: \"Montserrat\", sans-serif;">Order</a></li>
                <li><a href="about_us.php" style="font-size: 22px; font-family: \"Montserrat\", sans-serif;">About Us</a></li>

                

                <li>
                <a href="#" class="wallet-balance" onclick="openWalletPopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                        <!-- Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                        <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z"/>
                    </svg>
                    &nbsp; MYR <?php include 'wallet_balance_header.php'; ?>
                </a>
            </li>


            <li><a href="#" class="popup-trigger" onclick="openPopup()"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg></a></li>


            <li><a href="#" class="cart-win"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z"/></svg>&nbsp<?php include 'incart.php'; ?></a></li>

            
                <li><a href="#" class="message-popup" onclick="openPopupMessage()"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>&nbsp<?php include 'notification.php'; ?></a></li>

                <li><a href="logout_user.php"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></a></li>

            </ul>
        </nav>
    </header>


<style>
        .custom-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #007BFF;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            animation: fadeIn 0.5s ease-out;
        }

        .popup-content {
            text-align: center;
        }

        .popup-trigger-btn {
            cursor: pointer;
            color: #007BFF;
        }

        .popup-trigger-btn:hover+.custom-popup {
            display: block;
        }

        .close-btn {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #0056b3;
        }

        .custom-form label {
            display: block;
            margin-bottom: 5px;
        }

        .custom-form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            text-align: left; /* Set text alignment to left */
        }

        .custom-form input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .custom-form input[type="number"] {
            width: 50%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .custom-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .close-popup-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        cursor: pointer;
        color: #fff;
        background-color: #FF0000; /* Red color */
        padding: 5px 10px;
        border: none;
    }

    .close-popup-btn:hover {
        background-color: #CC0000; /* Darker red on hover */
    }



    </style>



<div class="custom-popup" id="custom-popup">
    <button class="close-popup-btn" onclick="closePopup()">X</button>
    <br>
    <div class="popup-content">
        <p>Setting to Change Username / Password</p>
        <form class="custom-form" action="username_pass_change.php" method="post">
            <label for="new-username">New Username:</label>
            <input type="text" id="new-username" name="new-username" value="<?php echo $row2['username']; ?>" required><br>

            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required><br>

            <label for="re-password">Re-Type Password:</label>
            <input type="password" id="re-password" name="re-password" required><br>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"><br>

            <button type="submit" class="custom-button" onclick="">Change</button>
        </form>
    </div>
</div>

    <script>
    function openPopup() {
        var popup = document.getElementById('custom-popup');
        popup.style.display = 'block';
    }

    function closePopup() {
        var popup = document.getElementById('custom-popup');
        popup.style.display = 'none';
    }
</script>

<?php
// Include the database configuration
include 'config.php';

// SQL query to fetch data from order_condition table
$sql10 = "SELECT * FROM order_condition WHERE user_id = $user_id AND sys_visible = '1'";

// Perform the query
$result10 = $conn->query($sql10);

// Check if the query was successful
if ($result10 === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    // Display the popup container
    echo '<div id="popup" class="popup-container" style="display: none;
                                              position: fixed;
                                              top: 20%;
                                              right: 10%;
                                              background-color: rgba(0, 0, 0, 0.5);
                                              padding: 20px;
                                              border-radius: 8px;
                                              box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                                              z-index: 1;
                                              width: 40%;">';

    // Display the popup content
    echo '<div class="popup-content" style="background-color: #fff;
                                                       padding: 20px;
                                                       border-radius: 8px;">';
    // Close popup button
    echo '<span class="close-popup" style="float: right;
                                                        font-size: 20px;
                                                        cursor: pointer;" onclick="closePopupMessage()">&times;</span>';
    // Popup title
    echo '<h2 style="text-align: left;">Notification</h2>';
    // Table for displaying order details
    echo '<table style="width: 100%;
                                      border-collapse: collapse;
                                      margin-top: 20px;">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="text-align: left;">Item Buy</th>';
    echo '<th style="text-align: left;">Status Ordering</th>';
    echo '<th></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Check if there are rows in the result set
    if ($result10->num_rows > 0) {
        while ($row10 = $result10->fetch_assoc()) {
            echo '<tr>';
            // Display order details and status
            echo '<td style="text-align: left;">' . $row10['details_order'] . '</td>';
            echo '<td style="text-align: left;">' . $row10['status'] . '</td>';
            echo '<td><a href="notification_read.php?order_condition_id=' . $row10['order_condition_id'] . '&restaurant_id=' . $row10['restaurant_id'] . '&user_id=' . $user_id . '">Read</a></td>';

            // Check if the status is REJECT
            if ($row10['status'] === 'REJECT') {
                // Show Rejected Details button and hide Receipt button
                echo '<td><a href="rejected_details.php?order_condition_id=' . $row10['order_condition_id'] . '&user_id=' . $user_id . '">Rejected Details</a></td>';
            } else {
                // Show Receipt button and hide Rejected Details button
                echo '<td><a href="receipt.php?order_condition_id=' . urlencode($row10['order_condition_id']) . '&restaurant_id=' . urlencode($row10['restaurant_id']) . '&user_id=' . urlencode($user_id) . '">Receipt</a></td>';

                //echo '<td><a href="receipt.php?order_conditions_id=' . $row10['order_condition_id'] . '&restaurant_id=' . $row10['restaurant_id'] . '&user_id=' . $user_id .'">Receipt</a></td>';
               //echo '<td><a href="receipt.php?order_conditions_id=' . $row10['order_condition_id'] . '&restaurant_id=' . $row10['restaurant_id'] . '&user_id=' . $user_id . '&details_order=' . $row10['details_order'] . '&total_amount=' . $row10['total_amount'] . '&order_accept_date=' . $row10['order_accept_date'] . '">Receipt</a></td>';

            }

            echo '</tr>';
        }
    } else {
        // Display a message when there are no rows
        echo '<tr><td colspan="4">No messages available.</td></tr>';
    }

    // Close the table and popup content
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';

    // Free the result set
    $result10->free();
}

// Close the database connection
$conn->close();
?>



<script>
function openPopupMessage() {
  document.getElementById('popup').style.display = 'block';
}

function closePopupMessage() {
  document.getElementById('popup').style.display = 'none';
}
</script>


<div id="wallet-popup" class="popup-container" style="display: none;
                                              position: fixed;
                                              top: 20%;
                                              right: 10%;
                                              background-color: rgba(0, 0, 0, 0.5);
                                              padding: 20px;
                                              border-radius: 8px;
                                              box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                                              z-index: 1;
                                              width: 40%;">
    <div class="popup-content" style="background-color: #fff;
                                       padding: 20px;
                                       border-radius: 8px;">
        <span class="close-popup" style="float: right;
                                        font-size: 20px;
                                        cursor: pointer;" onclick="closeWalletPopup()">&times;</span>
        <h2 style="text-align: left;">Top-up Wallet</h2>

        <form class="custom-form" action="ewallet_topup.php" id="topUpForm" method="post">
            <label for="topup-amount">Enter Amount (MYR):</label>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="number" id="topup-amount" name="topup-amount" placeholder="Enter amount" required><br>
            <button type="submit" class="custom-button">Top-up</button>
        </form>
    </div>
</div>


<script>
    
    function openWalletPopup() {
    document.getElementById('wallet-popup').style.display = 'block';
}

function closeWalletPopup() {
    document.getElementById('wallet-popup').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    var topUpForm = document.getElementById('topUpForm');

    topUpForm.addEventListener('submit', function (event) {
        // Add client-side validation if needed
        var amountInput = document.getElementById('topup-amount');
        var amountValue = parseFloat(amountInput.value);

        if (isNaN(amountValue) || amountValue < 10) {
            alert('Sorry, the minimum to top-up e-wallet is RM 10');
            event.preventDefault();
        }
    });
});



</script>

