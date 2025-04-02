


<style>
/* Add this code inside the <style> tag in the head */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

.modal-content img#previewImage {
  max-width: 100px; /* Adjust max-width as needed */
  height: 100px; /* Adjust height as needed */
  border-radius: 5px; /* Optional: Add border radius for a rounded appearance */
  margin-bottom: 10px; /* Optional: Add margin-bottom for spacing */
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.modal-content input[type="text"],
.modal-content input[type="email"],
.modal-content textarea,
.modal-content input[type="number"] {
  width: calc(100% - 20px); /* Adjusted width for padding */
  padding: 10px;
  margin: 8px 0;
  box-sizing: border-box;
  font-size: 16px; /* Set a common font size */
  border: 1px solid #ccc; /* Add a border for clarity */
  border-radius: 5px; /* Adjust border radius */
  text-align: left; /* Align text to the left */
}

/* Additional styling for the button with the new class */
.modal-content button.custom-button {
  background: linear-gradient(to right, #3498db, #e74c3c); /* Gradient from blue to pink */
  border: none;
  color: white;
  padding: 12px 24px; /* Adjust padding */
  font-size: 18px; /* Adjust font size */
  border-radius: 8px; /* Adjust border radius */
  cursor: pointer;
  transition: background 0.3s ease-in-out;
  margin-top: 15px; /* Adjust margin */
}

.modal-content button.custom-button:hover {
  background: linear-gradient(to right, #2980b9, #c0392b); /* Gradient on hover */
}
</style>

<div id="updateProfileModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>

<?php
// Include the database configuration
include 'config.php';

// Assuming you're using PHP to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $existingImage = $_POST['existingImage']; // You may need to handle the image separately

    // Check if 'newImage' key exists in $_FILES
    if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['newImage']['tmp_name'];
        $imageFileName = basename($_FILES['newImage']['name']);
        $imagePath = 'ADMIN/user-images/' . $imageFileName;

        // Move the uploaded file to the desired directory
        move_uploaded_file($imageTmpName, $imagePath);

        // Update query with the new image path
        $sql = "UPDATE users SET 
                email = '$email', 
                full_name = '$fullname', 
                address = '$address', 
                phone_number = '$phone',
                img_user = '$imagePath'
                WHERE user_id = '$user_id'";
    } else {
        // Update query without changing the image path
        $sql = "UPDATE users SET 
                email = '$email', 
                full_name = '$fullname', 
                address = '$address', 
                phone_number = '$phone'
                WHERE user_id = '$user_id'";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";


    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>




    <h2>Update Profile</h2>

    <?php
// Include the database connection configuration
include 'config.php';

// Assuming you have a user_id to fetch data for

// Fetch user data based on user_id
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Assign fetched data to variables
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


    <!-- Now, populate the form fields with the fetched data -->
    <form id="updateForm" action="" method="post" enctype="multipart/form-data">

  <label for="imageFile">Choose New Image</label>
  <input type="file" id="imageFile" name="newImage" accept="image/*">
  <!-- Display the existing image -->
  <label for="imageFile">Origin Image</label>
  <img id="previewImage" src="<?php echo $img_user; ?>" alt="Preview Image" style="max-width: 100px; height: 100px">

  <!-- Add a hidden input for the image file path -->
  <input type="hidden" id="existingImage" name="existingImage" value="<?php echo $img_user; ?>"><br><br>


      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>">

      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>">

      <label for="address">Address</label>
      <textarea id="address" name="address"><?php echo $address; ?></textarea>

      <label for="phone">Phone Number:</label>
      <input type="number" id="phone" name="phone" value="<?php echo $phone; ?>">

      <!-- Add other fields as needed -->

      <button type="submit" class="custom-button">Update</button>
    </form>
  </div>
</div>

<script>
// Add a JavaScript function to close the modal
function closeModal() {
  document.getElementById('updateProfileModal').style.display = 'none';
}
</script>
