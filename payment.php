<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Select Payment Option</h1>
    <form action="process_payment.php" method="post">
        <label for="payment_option">Payment Option:</label>
        <select name="payment_option" id="payment_option">
            <option value="pay_before_delivery">Pay Before Delivery</option>
            <option value="pay_after_delivery">Pay After Delivery</option>
        </select>
        <br>

        <!-- Payment method for "Pay Before Delivery" -->
        <?php if (isset($_POST["payment_option"]) && $_POST["payment_option"] === "pay_before_delivery") { ?>
        <div>
            <h2>Pay Before Delivery Options</h2>
            <label for="mpesa_payment">M-Pesa Payment:</label>
            <input type="text" name="mpesa_payment" id="mpesa_payment" placeholder="Enter M-Pesa details">
            <br>
        </div>
        <?php } ?>

        <!-- Payment method for "Pay After Delivery" -->
        <?php if (isset($_POST["payment_option"]) && $_POST["payment_option"] === "pay_after_delivery") { ?>
        <div>
            <h2>Pay After Delivery Instructions</h2>
            <p>Please make payment to the following PayBill number:</p>
            <p>PayBill Number: <strong>123456</strong></p>
        </div>
        <?php } ?>

        <input type="submit" value="Submit Payment">
    </form>
</body>
</html>
