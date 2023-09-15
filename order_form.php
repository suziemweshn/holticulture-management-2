<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php');
    exit();
}

// Check if checkout details are available in the session
$checkoutDetails = $_SESSION['checkout_details'] ?? [];

// Check if payment option is available in the session
//$paymentOption = $_SESSION['payment_option'] ?? '';
// Check if payment option is available in the session
$paymentOption = $_SESSION['payment_option'] ?? '';



// Check if the cart items are available in the session
$cartItems = $_SESSION['cart'] ?? [];

// Function to calculate the total price
function calculateTotalPrice($cartItems)
{
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += intval ($item['price'])* $item['quantity'];
    }
    return $totalPrice;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Order Summary</h1>

    <h2>Customer Details</h2>
    <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>

    <?php if (!empty($checkoutDetails)): ?>
    <h2>Delivery Details</h2>
    <p><strong>Delivery Address:</strong> <?php echo $checkoutDetails['address']; ?></p>
    <p><strong>Delivery Option:</strong> <?php echo $checkoutDetails['deliveryOption']; ?></p>
    <?php if (!empty($checkoutDetails['selectedAgent'])): ?>
        <p><strong>Selected Agent:</strong> <?php echo $checkoutDetails['selectedAgent']; ?></p>
    <?php endif; ?>

    <h2>Payment Option</h2>
    <p><strong>Payment Option:</strong> <?php echo $_SESSION['payment_option']; ?></p>


    <h2>Order Details</h2>
    <?php if (count($cartItems) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['description']; ?></td>
                    <td><?php echo $item['price']; ?> USD</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo intval($item['price']) * $item['quantity']; ?> USD</td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><strong>Total Price:</strong> $<?php echo calculateTotalPrice($cartItems); ?></p>

    <form action="confirm-order.php" method="post">
        <input type="submit" value="Confirm Order">
    </form>
    <form action="cancel-order.php" method="post">
    <input type="submit" value="Cancel Order">
</form>

    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>
    <?php else: ?>
    <p>No checkout details available. Please complete the checkout process first.</p>
    <?php endif; ?>

</body>
</html>
