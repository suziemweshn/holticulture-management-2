<?php
require 'vendor/autoload.php';

use Safaricom\Mpesa\Mpesa;

// Replace with your actual credentials and details
$consumerKey = 'GOjxSugLgkU2GwcDHDBmlYQqvwRy5TTN';
$consumerSecret = 'PU1ORQN0ncG4SYZl';
$environment = 'sandbox'; // Use 'sandbox' for testing, 'production' for live

// Initialize the Daraja API
$mpesa = new Mpesa($consumerKey, $consumerSecret, $environment);

// Payment details
$businessShortCode = 'YOUR_BUSINESS_SHORTCODE';
$amount = 100; // Replace with the actual amount
$customerPhoneNumber = 'CUSTOMER_PHONE_NUMBER'; // Replace with the customer's phone number
$callbackUrl = 'https://example.com/callback'; // Replace with your callback URL
$orderId = uniqid(); // Generate a unique order ID

try {
    // Create a Lipa Na M-Pesa Online Payment Request
    $payment = $mpesa->lipaNaMpesaOnline([
        'BusinessShortCode' => $businessShortCode,
        'Amount' => $amount,
        'PartyA' => $customerPhoneNumber,
        'PartyB' => $businessShortCode,
        'PhoneNumber' => $customerPhoneNumber,
        'CallBackURL' => $callbackUrl,
        'AccountReference' => $orderId,
        'TransactionDesc' => 'Payment for Order #' . $orderId,
    ]);

    // Redirect the customer to the M-Pesa payment page
    $paymentUrl = $payment['CheckoutRequestID'];
    header("Location: $paymentUrl");
    exit();
} catch (Exception $e) {
    // Handle any exceptions or errors that occur during the payment request
    echo 'Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Pesa Payment</title>
</head>
<body>
    <h1>M-Pesa Payment</h1>
    <p>Please wait while we redirect you to the M-Pesa payment page...</p>
</body>
</html>
