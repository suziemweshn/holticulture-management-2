<?php
session_start();

// Check if checkout details are stored in the session
/*if (!isset($_SESSION['checkout_details'])) {
    header('Location: customer-login.php');
    exit();
}*/
include 'conn.php';


$checkoutDetails = $_SESSION['checkout_details'];

$address = $checkoutDetails['address'] ?? '';
$deliveryOption = $checkoutDetails['deliveryOption'] ?? '';
$country = $checkoutDetails['country'] ?? '';
$city = $checkoutDetails['city'] ?? '';
$location = $checkoutDetails['location'] ?? '';
$selectedAgent = $checkoutDetails['selectedAgent'] ?? '';
$alt_phone_number = $checkoutDetails['alt_phone_number'] ?? '';


// Define payment options (replace with actual payment options)
$paymentOptions = [
    'credit_card' => 'Credit Card',
    'paypal' => 'PayPal',
    'cash_on_delivery' => 'Cash on Delivery',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a payment option is selected
    if (isset($_POST['payment_option']) && isset($paymentOptions[$_POST['payment_option']])) {
        // Store the selected payment option in the session
        $_SESSION['payment_option'] = $_POST['payment_option'];

        // Redirect to the order_form.php page
        header('Location: order_form.php');
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Select Payment Option</h1>
    <form method="POST" action="payment.php">
     <p>Checkout Details:</p>
        <ul>
            <li>Name: <?php echo $checkoutDetails['name']; ?></li>
            <li>Phone Number: <?php echo $checkoutDetails['phone_no']; ?></li>
            <li>Phone Number: <?php echo $checkoutDetails['alt_phone_number']; ?></li>
            <li>Email: <?php echo $checkoutDetails['email']; ?></li>
            <li>Address: <?php echo ($address); ?></li>
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

        <label for="payment_option">Select Payment Option:</label>
        <select name="payment_option" id="payment_option" required>
            <option value="" disabled selected>Select Payment Option</option>
            <?php foreach ($paymentOptions as $key => $option) { ?>
                <option value="<?php echo $key; ?>"><?php echo $option; ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Proceed to Payment">
    </form>
</body>
</html>
