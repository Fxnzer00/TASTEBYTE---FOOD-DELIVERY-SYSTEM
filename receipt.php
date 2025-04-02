<?php
include 'config.php';

if (isset($_GET['order_condition_id'], $_GET['restaurant_id'], $_GET['user_id'])) {

    // Retrieve values from the URL
    $order_condition_id = $_GET['order_condition_id'];
    $restaurant_id = $_GET['restaurant_id'];
    $user_id = $_GET['user_id'];

    // Perform database update query
    // Assuming you have a database connection established

    // Make sure to sanitize input to prevent SQL injection
    $order_condition_id = intval($order_condition_id);
    $restaurant_id = intval($restaurant_id);
    $user_id = intval($user_id);

    $query = "SELECT 
                oc.details_order,
                oc.total_amount,
                oc.order_accept_date,
                u.username,
                u.address,
                r.name AS restaurant_name,
                r.email AS restaurant_email,
                r.phone_number AS restaurant_phone_number
              FROM order_condition oc
              JOIN users u ON oc.user_id = u.user_id
              JOIN restaurants r ON oc.restaurant_id = r.restaurant_id
              WHERE oc.user_id = $user_id AND oc.order_condition_id = $order_condition_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Access the data
        $details_order = $row['details_order'];
        $total_amount = $row['total_amount'];
        $order_accept_date = $row['order_accept_date'];
        $username = $row['username'];
        $address = $row['address'];
        $restaurant_name = $row['restaurant_name'];
        $restaurant_email = $row['restaurant_email'];
        $restaurant_phone_number = $row['restaurant_phone_number'];

        // Don't forget to close the connection when done
        mysqli_close($conn);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
        // Don't forget to close the connection in case of an error
        mysqli_close($conn);
        exit(); // Exit to prevent further execution of the code
    }
} else {
    // Handle missing parameters
    echo "Missing parameter(s): ";
    if (!isset($_GET['order_condition_id'])) echo "order_condition_id ";
    if (!isset($_GET['restaurant_id'])) echo "restaurant_id ";
    if (!isset($_GET['user_id'])) echo "user_id ";
    exit(); // Exit to prevent further execution of the code
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .receipt {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 90%; /* Adjusted width for responsiveness */
            max-width: 1300px; /* Set a maximum width */
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Media query for responsiveness */
        @media (max-width: 600px) {
            .receipt {
                width: 100%;
                max-width: none;
            }
        }
    </style>
    <title>Receipt Template</title>

    <!-- Include jsPDF library -->
    

</head>
<body>

<?php
$totaltax = ($total_amount*6)/100;
$totalall = $totaltax + $total_amount + 4.50;
?>

<div class="receipt">
    <h2>Your Receipt</h2>
    <table id="receiptTable">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Restaurant's Name</th>
            <th>Details Order</th>
            <th>Restaurant Contact</th>
            <th>Order Date/Time</th>
            <th>Total Amount (Inc Delivery & Service Charge)</th>
        </tr>
        <tr>
            <td><?php echo $username; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $restaurant_name; ?></td>
            <td><?php echo $details_order; ?></td>
            <td><?php echo $restaurant_phone_number; ?><br><?php echo $restaurant_email; ?></td>
            <td><?php echo $order_accept_date; ?></td>
            <td>RM <?php echo $totalall; ?></td>
        </tr>
        <tr>
            <td colspan="7">Order ID: <?php echo $order_condition_id; ?></td>
        </tr>
    </table>
    <button onclick="printReceipt()">Print Receipt (PDF)</button>
    <button onclick="goToHomepage()">Back to Homepage</button>
</div>

<script>
function printReceipt() {
    // Call the browser's print function
    window.print();
}

    function goToHomepage() {
        // Redirect to index_user.php
        window.location.href = 'index_user.php';
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

</body>
</html>