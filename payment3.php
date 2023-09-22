<?php
session_start();

include 'oauth.php';
include 'conn.php';

// Retrieve user details from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Retrieve checkout details from the session
$checkoutDetails = isset($_SESSION['checkout_details']) ? $_SESSION['checkout_details'] : array();

if (!empty($username) && !empty($checkoutDetails)) {
    // Extract checkout details from the session
    $name = $checkoutDetails['name'] ?? '';
    $email = $checkoutDetails['email'] ?? '';
    $phone_no = $checkoutDetails['phone_no'] ?? '';
    $alt_phone_number = $checkoutDetails['alt_phone_number'] ?? '';
    $customerAddress = $checkoutDetails['address'] ?? '';
    $country = $checkoutDetails['country'] ?? '';
    $city = $checkoutDetails['city'] ?? '';
    $location = $checkoutDetails['location'] ?? '';
    $deliveryOption = $checkoutDetails['deliveryOption'] ?? '';
    $selectedAgent = $checkoutDetails['selectedAgent'] ?? '';
    $agentNumber = $checkoutDetails['agentNumber'] ?? '';
    $gender = $checkoutDetails['gender'] ?? '';
    $contactNumber = $checkoutDetails['contactNumber'] ?? '';
    $paymentOption = $_POST['paymentOption'] ?? ''; // Assuming the payment option is posted from the form

    // Insert checkout details into another table (e.g., payment_table)
    $insertPaymentQuery = "INSERT INTO payment (name, email, phone_no, alt_phone_number, address, country, city, location, delivery_option, selected_agent, agent_number, gender, contact_number, username, payment_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $insertPaymentStmt = $conn->prepare($insertPaymentQuery);

    if ($insertPaymentStmt) {
        // Bind the parameters
        $insertPaymentStmt->bind_param("sssssssssssssss", $name, $email, $phone_no, $alt_phone_number, $customerAddress, $country, $city, $location, $deliveryOption, $selectedAgent, $agentNumber, $gender, $contactNumber, $username, $paymentOption);

        // Execute the statement
        if ($insertPaymentStmt->execute()) {
            // Payment details successfully inserted into the payment_table
            echo "Payment details inserted successfully.";
          //  header('Location: payment.php');
           
           
           
        } else {
            // Handle the execution error
            echo "Error executing SQL query: " . $insertPaymentStmt->error;
        }

        // Close the statement
        $insertPaymentStmt->close();
    } else {
        // Handle the prepare error
        echo "Error preparing SQL statement: " . $conn->error;
    }
} else {
    // Handle the scenario where username or checkout details are not available
    echo "Username or checkout details not found.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML content and any additional JavaScript can go here -->
</head>
<body>
    <h1>Payment Page</h1>
    <!-- Your payment page content here -->
    <form method="POST" >
    <p>Checkout Details:</p>
        <ul>
            <li>Name: <?php echo $checkoutDetails['name']; ?></li>
            <li>Phone Number: <?php echo $checkoutDetails['phone_no']; ?></li>
            <li>Phone Number: <?php echo $checkoutDetails['alt_phone_number']; ?></li>
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

        <!-- Include your payment options form elements here -->
        <label for="paymentOption">Payment Option:</label>
        <select name="paymentOption" id="paymentOption">
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <!-- Add other payment options as needed -->
        </select>
        <input type="submit" value="Submit Payment">
    </form>
</body>
</html>

