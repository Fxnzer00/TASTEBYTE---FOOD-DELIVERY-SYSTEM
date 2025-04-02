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



// Include the database connection configuration
include 'config.php';

// Assuming you have a user_id to fetch data for

// Fetch user data based on user_id
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Assign fetched data to variables
    $username = $row['username'];
    $email = $row['email'];
    $fullname = $row['full_name'];
    $address = $row['address'];
    $phone = $row['phone_number'];
    $img_user = $row['img_user'];
} else {
    echo "No user found with the given user_id";
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Profile</title>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="scripts.js" defer></script>



</head>
<body>
        <?php include 'header_page.php'; ?>

<section class="main-content">
<center><br>
    <div class="profile-container">
        <div class="profile-info">


            <img src="<?php echo $img_user; ?>" alt="Please Update Your Image" width = "150px" height = "200px">
            <h2><?php echo $row['username']; ?></h2>
            <p>Full Name : <?php echo $fullname; ?></p>
            <p>Email : <?php echo $email; ?></p>
            <p>Address: <?php echo $address; ?></p>
            <p>Phone: <?php echo $phone; ?></p>
        </div>
        <button id="updateProfileBtn" style="
            background: linear-gradient(to right, #3498db, #e74c3c);
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        "
        >Change Profile Details</button>
    </div>
<br>
    <button id="refreshBtn" style="
    background: linear-gradient(to right, #2ecc71, #3498db);
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 12px;
    cursor: pointer;
    margin-bottom: 30px;
    transition: background-color 0.3s ease-in-out;
">Save</button>


</center>

<br><br>

</section>

        <?php
        include 'cart_info.php';
        ?>

    <footer style="background: linear-gradient(to right, #2ecc71, #3498db);">
        <p>&copy; © 2024 TASTEBYTE MY, ALL RIGHTS RESERVED.</p>
    </footer>



<!-- Add this code inside the <body> tag, after the profile section -->

        <?php
        include 'popup_profile_user.php';
        ?>
<script>
function openModal() {
  document.getElementById('updateProfileModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('updateProfileModal').style.display = 'none';
}

// Attach a click event to the "Update Profile" button
document.getElementById('updateProfileBtn').addEventListener('click', openModal);

// Attach a click event to the "Refresh" button
document.getElementById('refreshBtn').addEventListener('click', function() {
  location.reload();
});
</script>




</body>
</html>
