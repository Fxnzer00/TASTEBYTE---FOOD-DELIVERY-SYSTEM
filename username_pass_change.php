<?php
// Include database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_id = $_POST["user_id"];
    $newUsername = $_POST["new-username"];
    $newPassword = $_POST["new-password"];
    $rePassword = $_POST["re-password"];

    // Validate if passwords match
    if ($newPassword != $rePassword) {
        echo "<script>
            alert('Passwords do not match.');
            window.history.back(); // Go back to the previous page
          </script>";
    exit();

        // You may want to redirect or display an error message
    } else {
        // Hash the new password (you should use a secure hash function)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Assuming your table name is 'users'
        $query = "UPDATE users SET username = '$newUsername', password = '$hashedPassword' WHERE user_id = $user_id";
        
        // Prepare and execute the query
        $statement = $conn->prepare($query);
        $result = $statement->execute();

        if ($result) {
            echo "<html>
            <head>
                <style>
                    /* CSS for the popup */
                    @keyframes fadeIn {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }

                    .popup {
                        display: none;
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        animation: fadeIn 0.5s ease-in-out;
                    }
                </style>
            </head>
            <body>
                <div class='popup'>
                    Your account needs to restart due to some changes in Username and Password.
                </div>
                <script>
                    // JavaScript for showing the popup
                    document.addEventListener('DOMContentLoaded', function() {
                        var popup = document.querySelector('.popup');
                        popup.style.display = 'block';
                        setTimeout(function() {
                            popup.style.display = 'none';
                            window.location.href = 'loginsignup_user.php';
                        }, 5000); // Adjust the time the popup is displayed (in milliseconds)
                    });
                </script>
            </body>
          </html>";
    exit();
        } else {
            echo "Error updating user information.";
            // You may want to redirect or display an error message
        }
    }
}

// Close the database connection
$conn->close();
?>