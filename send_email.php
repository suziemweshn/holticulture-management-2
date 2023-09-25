<?php
session_start();
include 'conn.php';

// Check if the user is logged in
if (isset($_POST['username'])) {
    // Get the username
    $username = $_POST['username'];

    // Retrieve user details from the session
    $usernameSession = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    // Check if the provided username matches the session username
    if ($username === $usernameSession) {
        // Retrieve user profile details from the customer_table
        $stmt = $conn->prepare("SELECT * FROM customer_table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'] ?? '';
            $name = $row['name'] ?? '';

            // Retrieve the order_id from the total_prices table
            $totalPriceQuery = "SELECT order_id FROM total_prices ORDER BY order_id DESC LIMIT 1";
            $totalPriceResult = $conn->query($totalPriceQuery);
            $orderId = $totalPriceResult->fetch_assoc()['order_id'] ?? '';

            if (!$orderId) {
                echo "Failed to retrieve order ID.";
                exit();
            }

            // Compose the mailto link for approval
            $subject = "Subject: AHF Order Approval";
            $body = "Dear $name, Your order with Order ID: $orderId has been approved.  Thank you for shopping with us!";
            $mailtoApproval = "mailto:$email?subject=" . rawurlencode($subject) . "&body=" . rawurlencode($body);

            // Compose the mailto link for decline
            $subject = "Subject: AHF Order Decline";
            $body = "Dear $name, We regret to inform you that your order has been declined...";
            $mailtoDecline = "mailto:$email?subject=" . rawurlencode($subject) . "&body=" . rawurlencode($body);

            // Return the mailto links as JSON response, including a button to view the order
            $response = [
                'approval_link' => $mailtoApproval,
                'decline_link' => $mailtoDecline,
                'view_order_button' => "<a href='order_form.php?order_id=$orderId'><button>View Order</button></a>"
            ];

            echo json_encode($response);
        } else {
            // User not found in the customer_table
            // Handle the scenario accordingly, e.g., display an error message
            echo "User profile not found!";
        }
    } else {
        // Provided username does not match the session username
        echo "Unauthorized access!";
    }
}

$stmt->close();
$conn->close();
?>
