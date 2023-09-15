<?php
session_start();
include 'conn.php';

// Include your database connection code here if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_option = $_POST['payment_option'] ?? '';

    // Check if the payment option is not empty
    if (!empty($payment_option)) {
        // Retrieve user details from the session
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        // Insert data into the payment table
        $sql = "INSERT INTO payment (username, payment_option) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $username, $payment_option);

            if ($stmt->execute()) {
                // Payment data inserted successfully
                $stmt->close();
                $conn->close();
              //  echo "Payment option stored successfully!";
              header('location: order_confirmation.php');
            } else {
                echo "Error inserting payment option: " . $stmt->error;
            }
        } else {
            echo "Error preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "Payment option is empty.";
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
    <form action="payment.php" method="post">
        <label for="payment_option">Payment Option:</label>
        <select name="payment_option" id="payment_option">
            <option value="pay_before_delivery">Pay Before Delivery</option>
            <option value="pay_after_delivery">Pay After Delivery</option>
        </select>
        <br>

        <input type="submit" value="Submit Payment">
    </form>
</body>
</html>
