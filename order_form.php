<?php
session_start();

$checkoutDetails = $_SESSION['checkout_details'];

if (!isset($_SESSION['payment_option'])) {
    header('Location: payment.php');
    exit();
}

$paymentOption = $_SESSION['payment_option'];

if (!isset($_SESSION['checkout_items'])) {
    header('Location: checkout.php');
    exit();
}

$checkoutItems = $_SESSION['checkout_items'];

$totalPrice = 0;
foreach ($checkoutItems as $item) {
    $totalPrice += $item['price'];
}

function storeOrderDetails($checkoutDetails, $paymentOption, $checkoutItems, $totalPrice)
{
    include 'conn.php'; // Include your database connection

    $insertOrderQuery = "INSERT INTO orders (username, name, email, phone_no, alt_phone_number, address, country, city, location, delivery_option, selected_agent, agent_number, gender, contact_number, payment_option, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertOrderStmt = $conn->prepare($insertOrderQuery);
    
    if (!$insertOrderStmt) {
        echo "Error preparing order SQL statement: " . $conn->error;
        return false;
    }

    $username = $_SESSION['username'];

    $insertOrderStmt->bind_param("sssssssssssssssd", $username, $checkoutDetails['name'], $checkoutDetails['email'], $checkoutDetails['phone_no'], $checkoutDetails['alt_phone_number'], $checkoutDetails['address'], $checkoutDetails['country'], $checkoutDetails['city'], $checkoutDetails['location'], $checkoutDetails['deliveryOption'], $checkoutDetails['selectedAgent'], $checkoutDetails['agentNumber'], $checkoutDetails['gender'], $checkoutDetails['contactNumber'], $paymentOption, $totalPrice);

    if (!$insertOrderStmt->execute()) {
        echo "Error executing order SQL query: " . $insertOrderStmt->error;
        return false;
    }

    $orderId = $insertOrderStmt->insert_id;

    foreach ($checkoutItems as $item) {
        $insertOrderItemQuery = "INSERT INTO order_items (order_id, username, product_name, price) VALUES (?, ?, ?, ?)";
        $insertOrderItemStmt = $conn->prepare($insertOrderItemQuery);
    
        if (!$insertOrderItemStmt) {
            echo "Error preparing order items SQL statement: " . $conn->error;
            return false;
        }
    
        $insertOrderItemStmt->bind_param("isss", $orderId, $username, $item['name'], $item['price']);
    
        if (!$insertOrderItemStmt->execute()) {
            echo "Error executing order items SQL query: " . $insertOrderItemStmt->error;
            return false;
        }
    }

    // Calculate and store the total price in the total_prices table
    $insertTotalPriceQuery = "INSERT INTO total_prices (order_id, total_price) VALUES (?, ?)";
    $insertTotalPriceStmt = $conn->prepare($insertTotalPriceQuery);

    if (!$insertTotalPriceStmt) {
        echo "Error preparing total price insert SQL statement: " . $conn->error;
        return false;
    }

    $insertTotalPriceStmt->bind_param("id", $orderId, $totalPrice);

    if (!$insertTotalPriceStmt->execute()) {
        echo "Error inserting total price: " . $insertTotalPriceStmt->error;
        return false;
    }

    return true;
}

if (isset($_POST['confirm'])) {
    if (storeOrderDetails($checkoutDetails, $paymentOption, $checkoutItems, $totalPrice)) {
        header('Location: order_success.php');
        exit();
    } else {
        echo "Failed to store order details.";
    }
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

    <!-- Add Confirm and Cancel buttons -->
    <form method="POST" action="order_form.php">
        <button type="submit" name="confirm">Confirm</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
