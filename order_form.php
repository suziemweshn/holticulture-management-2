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

// Function to store checkout details into the order table
function storeOrderDetails($checkoutDetails, $paymentOption, $checkoutItems)
{
    include 'conn.php'; // Include your database connection

    // Insert checkout details into the order table
    $insertOrderQuery = "INSERT INTO orders (username, name, email, phone_no, alt_phone_number, address, country, city, location, delivery_option, selected_agent, agent_number, gender, contact_number, payment_option, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertOrderStmt = $conn->prepare($insertOrderQuery);
    
    if (!$insertOrderStmt) {
        echo "Error preparing order SQL statement: " . $conn->error;
        return false;
    }

    $username = $_SESSION['username']; // Get the username from the session

    $insertOrderStmt->bind_param("sssssssssssssssd", $username, $checkoutDetails['name'], $checkoutDetails['email'], $checkoutDetails['phone_no'], $checkoutDetails['alt_phone_number'], $checkoutDetails['address'], $checkoutDetails['country'], $checkoutDetails['city'], $checkoutDetails['location'], $checkoutDetails['deliveryOption'], $checkoutDetails['selectedAgent'], $checkoutDetails['agentNumber'], $checkoutDetails['gender'], $checkoutDetails['contactNumber'], $paymentOption, $totalPrice);

    if (!$insertOrderStmt->execute()) {
        echo "Error executing order SQL query: " . $insertOrderStmt->error;
        return false;
    }

    $orderId = $insertOrderStmt->insert_id;

    // Insert checkout items into the order_items table
    foreach ($checkoutItems as $item) {
    $insertOrderItemQuery = "INSERT INTO order_items (order_id, username, product_name, price, total_price) VALUES (?, ?, ?, ?, ?)";
    $insertOrderItemStmt = $conn->prepare($insertOrderItemQuery);

    if (!$insertOrderItemStmt) {
        echo "Error preparing order items SQL statement: " . $conn->error;
        return false;
    }

    $insertOrderItemStmt->bind_param("isssd", $orderId, $username, $item['name'], $item['price'], $totalPrice);

    if (!$insertOrderItemStmt->execute()) {
        echo "Error executing order items SQL query: " . $insertOrderItemStmt->error;
        return false;
    }
}
    return true;
}

// Check if the Confirm button is clicked
if (isset($_POST['confirm'])) {
    // Call the function to store order details
    if (storeOrderDetails($checkoutDetails, $paymentOption, $checkoutItems)) {
        // Order details successfully stored, you can redirect or display a success message here
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
