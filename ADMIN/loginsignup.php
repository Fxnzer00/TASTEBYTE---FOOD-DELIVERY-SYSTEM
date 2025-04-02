
<?php
session_start();
include 'config.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Login logic
if (isset($_POST['login'])) {
    $loginIdentifier = sanitize_input($_POST['email']); // New field for both email or username
    $password = sanitize_input($_POST['password']);

    // Check if the login identifier is an email or username
    $isEmail = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL);

    $sql = $isEmail ? "SELECT * FROM restaurants WHERE email = ?" : "SELECT * FROM restaurants WHERE username = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $loginIdentifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Valid login, set session and redirect to dashboard.php
            $_SESSION['user_id'] = $row['restaurant_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessage = "Invalid password";
        }
    } else {
        $errorMessage = "Invalid username or email";
    }

    $stmt->close();
}

// Registration logic
if (isset($_POST['register'])) {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM restaurants WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        $errorMessage = "Email already exists. Please choose a different email.";
    } else {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $insertQuery = "INSERT INTO restaurants (username, password, email) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($insertStmt->execute()) {
            $successMessage = "Registration successful! Please log in.";
        } else {
            $errorMessage = "Error: " . $conn->error;
        }

        $insertStmt->close();
    }

    $checkEmailStmt->close();
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="login-style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="loginimages/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Welcome to Food Ordering <br> Management System</span>
          <span class="text-2">Please Login</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="loginimages/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Manage your food <br> with advanced system</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
         <form action="loginsignup.php" method="post">
    <div class="input-boxes">
        <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="text"><a href="#">Forgot password?</a></div>
        <div class="button input-box">
            <input type="submit" value="Submit" name="login">
        </div>
        <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
    </div>
</form>
      </div>


   <div class="signup-form">
        <div class="title">Signup</div>
        <form action="loginsignup.php" method="post">
            <div class="input-boxes">
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Enter your name" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="button input-box">
                    <input type="submit" value="Sumbit" name="register">
                </div>
                <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
        </form>
    </div>

    </div>
    </div>
  </div>

<div id="notificationsuccess" class="notificationsuccess <?php echo $successMessage ? 'show' : ''; ?>">
  <p><?php echo $successMessage; ?></p>
</div>

<div id="notificationerror" class="notificationerror <?php echo $errorMessage ? 'show' : ''; ?>">
  <p><?php echo $errorMessage; ?></p>
</div>


</body>
</html>


