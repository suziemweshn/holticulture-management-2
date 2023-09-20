<?php
session_start();

// Check if checkout details are stored in the session
/*if (!isset($_SESSION['checkout_details'])) {
    header('Location: checkout.php');
    exit();
}*/

$checkoutDetails = $_SESSION['checkout_details'];

// Check if a payment option is selected and stored in the session
if (!isset($_SESSION['payment_option'])) {
    header('Location: payment.php');
    exit();
}

$paymentOption = $_SESSION['payment_option'];

// Check if checkout items are stored in the session
if (!isset($_SESSION['checkout_items'])) {
    header('Location: checkout.php');
    exit();
}

$checkoutItems = $_SESSION['checkout_items'];

// Calculate the total price
$totalPrice = 0;
foreach ($checkoutItems as $item) {
    $totalPrice += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <h2>Checkout Details:</h2>
    <ul>
        <li>Name: <?php echo $checkoutDetails['name']; ?></li>
        <li>Phone Number: <?php echo $checkoutDetails['phone_no']; ?></li>
        <li>Alternative Phone Number: <?php echo $checkoutDetails['alt_phone_number']; ?></li>
        <li>Email: <?php echo $checkoutDetails['email']; ?></li>
        <li>Address: <?php echo $checkoutDetails['address']; ?></li>
        <li>Country: <?php echo $checkoutDetails['country']; ?></li>
        <li>City: <?php echo $checkoutDetails['city']; ?></li>
        <li>Location: <?php echo $checkoutDetails['location']; ?></li>
        <li>Delivery Option: <?php echo $checkoutDetails['deliveryOption']; ?></li>
        <?php if ($checkoutDetails['deliveryOption'] === 'pickup') { ?>
            <li>Selected Agent: <?php echo $checkoutDetails['selectedAgent']; ?></li>
            <li>Agent Number: <?php echo $checkoutDetails['agentNumber']; ?></li>
            <li>Gender: <?php echo $checkoutDetails['gender']; ?></li>
            <li>Contact Number: <?php echo $checkoutDetails['contactNumber']; ?></li>
        <?php } ?>
    </ul>

    <h2>Payment Option:</h2>
    <p><?php echo $paymentOption; ?></p>

    <h2>Ordered Items:</h2>
    <ul>
        <?php foreach ($checkoutItems as $item) { ?>
            <li>
                Item Name: <?php echo $item['name']; ?><br>
                Item Price: <?php echo $item['price']; ?><br>
                <!-- Add more item details as needed -->
            </li>
        <?php } ?>
    </ul>

    <h2>Total Price:</h2>
    <p><?php echo $totalPrice; ?></p>

    <!-- You can add more content here, such as order summary, total price, etc. -->

    <p>Your order has been confirmed. Thank you for shopping with us!</p>
</body>
</html>
