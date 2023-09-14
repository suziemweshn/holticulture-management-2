<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the payment option is selected
    if (isset($_POST["payment_option"])) {
        $payment_option = $_POST["payment_option"];

        if ($payment_option === "pay_before_delivery") {
            // Payment processing for "Pay Before Delivery" option (M-Pesa or other payment gateway)
            $mpesa_details = $_POST["mpesa_payment"];
            // Implement your payment processing logic here, e.g., M-Pesa API integration

            // After successful payment processing, you can redirect to a success page
            header("Location: payment_success.php");
            exit;
        } elseif ($payment_option === "pay_after_delivery") {
            // Payment processing for "Pay After Delivery" option (PayBill number or other instructions)
            // You can provide instructions to the user for making the payment
            $paybill_number = "123456"; // Replace with your actual PayBill number

            // Display a message to the user with payment instructions
            $payment_instructions = "Please make a payment of your choice to the following PayBill number: $paybill_number";
        } else {
            // Invalid payment option selected
            $error_message = "Invalid payment option selected.";
        }
    } else {
        // Payment option not selected
        $error_message = "Payment option is required.";
    }
} else {
    // Invalid request method
    $error_message = "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Processing</title>
</head>
<body>
    <h1>Payment Processing</h1>
    <?php if (isset($error_message)) { ?>
        <p>Error: <?php echo $error_message; ?></p>
    <?php } ?>

    <?php if (isset($payment_instructions)) { ?>
        <p><?php echo $payment_instructions; ?></p>
    <?php } ?>

    <p><a href="payment.php">Back to Payment Options</a></p>
</body>
</html>
