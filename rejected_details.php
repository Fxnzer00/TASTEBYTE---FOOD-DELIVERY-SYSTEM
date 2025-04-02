
<?php
include 'config.php';

// Check if the required parameters are set in the URL
if (isset($_GET['order_condition_id'], $_GET['user_id'] )) {
    
    // Retrieve values from the URL
    $order_condition_id = $_GET['order_condition_id'];
    $user_id = $_GET['user_id'];

    $order_condition_id = intval($order_condition_id);
    $user_id = intval($user_id);
    
    // Assuming you have a database connection, perform a query to fetch details
    $query = "SELECT * FROM order_condition WHERE order_condition_id = $order_condition_id AND user_id =$user_id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the details from the result set
        $row = mysqli_fetch_assoc($result);
        
        // Output the details in your HTML
        $details_order = $row['details_order'];
        $total_amount = $row['total_amount'];
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Rejection Reasons</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    .reasons-list {
      list-style: none;
      padding: 0;
    }

    .reasons-list li {
      margin-bottom: 10px;
    }

    .reasons-list li span {
      font-weight: bold;
    }
  </style>
</head>
<body>

<?php
$totaltax = ($total_amount*6)/100;
$totalall = $totaltax + $total_amount + 4.50;
?>

  <div class="container">

    <h1><center>Customer's Details Order</center></h1>
    <ul class="reasons-list">
      <li>Item: <?php echo $details_order; ?></li>
      <li>Total amount already refund into ewallet Inc Service Charge and Delivery Charge: RM <?php echo $totalall; ?></li>
      <!-- Add more details as needed -->
    </ul>

    <h1><center>Food Rejection Reasons</center></h1>
    <ul class="reasons-list">
      <li><span>1.</span> Out of Stock: The item you ordered is currently unavailable.</li>
      <li><span>2.</span> Quality Issues: The quality of the food product did not meet our standards.</li>
      <li><span>3.</span> Delivery Constraints: We are unable to deliver to your location at the moment.</li>
      <li><span>4.</span> Technical Issues: There are technical problems affecting the order processing.</li>
      <!-- Add more reasons as needed -->
    </ul>

<br><br>
<h1><center>Sorry For Inconvenience Caused</center></h1>

  </div>

</body>
</html>
