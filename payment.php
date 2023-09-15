<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_option = $_POST['payment_option'] ?? '';
    $_SESSION['payment_option'] = $payment_option;

    // Debug: Output the payment option to check its value
    var_dump($_SESSION['payment_option']);
    if (!empty($payment_option)) {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        // Retrieve user's checkout details from session
        $checkoutDetails = $_SESSION['checkout_details'] ?? [];

        $address = $checkoutDetails['address'] ?? '';
        $deliveryOption = $checkoutDetails['deliveryOption'] ?? '';
        $country = $checkoutDetails['country'] ?? '';
        $city = $checkoutDetails['city'] ?? '';
        $location = $checkoutDetails['location'] ?? '';
        $selectedAgent = $checkoutDetails['selectedAgent'] ?? '';

        // Insert data into the checkout table
        $sql = "INSERT INTO checkout (username, name, email, phone_no, address, delivery_mode, agent_name, country, city, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Assuming you have the user's name, email, and phone number available
            $name = ''; // Add user's name here
            $email = ''; // Add user's email here
            $phone_no = ''; // Add user's phone number here

            $stmt->bind_param("ssssssssss", $username, $name, $email, $phone_no, $address, $deliveryOption, $selectedAgent, $country, $city, $location);

            if ($stmt->execute()) {
                // Payment data inserted successfully
                $stmt->close();
                $conn->close();
                header('Location: order_form.php');
                exit();
            } else {
                echo "Error inserting into the checkout table: " . $stmt->error;
            }

            $stmt->close();
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

        
        <input type="submit" value="Proceed to Payment">
    </form>
</section>

      
</body>
</html>
