<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php');
    exit();
}

// Include your database connection code here
include 'conn.php';

// Retrieve the current user's username
$username = $_SESSION['username'];

// Step 1: Create an SQL query to retrieve data from cart, checkout, and payment tables
$sql = "SELECT c.id AS cart_id, c.name, c.description, c.price, o.id AS checkout_id, o.delivery_mode, p.id AS payment_id, p.payment_option
        FROM cart c
        JOIN checkout o ON c.username = o.username
        JOIN payment p ON c.username = p.username
        WHERE c.username = '$username'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Step 2: Fetch the data
$orderSummary = array(); // Initialize an array to store order summary data

while ($row = mysqli_fetch_assoc($result)) {
    $orderSummary[] = $row;
}

// Step 3: Display the order summary on the order-confirmation.php page
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <!-- Add your styles and headers here -->
</head>
<body>
    <h1>Order Confirmation</h1>
    <?php foreach ($orderSummary as $order): ?>
        <div>
            <h2>Cart ID: <?php echo $order['cart_id']; ?></h2>
            <p>Product Name: <?php echo $order['name']; ?></p>
            <p>Description: <?php echo $order['description']; ?></p>
            <p>Price: $<?php echo $order['price']; ?></p>
            <p>Checkout ID: <?php echo $order['checkout_id']; ?></p>
            <p>Delivery Mode: <?php echo $order['delivery_mode']; ?></p>
            <p>Payment ID: <?php echo $order['payment_id']; ?></p>
            <p>Payment Method: <?php echo $order['payment_option']; ?></p>
            <!-- Add more order details as needed -->
        </div>
    <?php endforeach; ?>
    <a href="customer-profile.php">Back to Profile</a>
</body>
</html>
