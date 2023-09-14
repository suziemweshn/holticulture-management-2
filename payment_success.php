<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Success</h1>
    
    <p>Thank you for choosing the "Pay Before Delivery" option. To complete your payment, please click the link below:</p>
    
    <?php
    // Simulated M-Pesa payment link (replace with actual M-Pesa integration)
    $mpesa_payment_link = 'https://www.safaricom.com/';
    ?>
    
    <a href="<?php echo $mpesa_payment_link; ?>" target="_blank">Pay with M-Pesa</a>
    
    <p><a href="payment.php">Back to Payment Options</a></p>
</body>
</html>
