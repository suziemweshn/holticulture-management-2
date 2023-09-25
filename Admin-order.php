<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Order Details</h1>
    
    <?php
    include 'conn.php'; // Include your database connection

    // Query to retrieve all available order_ids with product names, quantities, and total_price
    $query = "SELECT oi.order_id, oi.product_name, oi.quantity, tp.total_price, o.username
              FROM order_items oi
              JOIN (
                  SELECT order_id, total_price
                  FROM total_prices
              ) tp ON oi.order_id = tp.order_id
              JOIN orders o ON oi.order_id = o.id
              ORDER BY oi.order_id";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo "Error preparing SQL statement: " . $conn->error;
        exit();
    }

    if (!$stmt->execute()) {
        echo "Error executing SQL query: " . $stmt->error;
        exit();
    }

    $result = $stmt->get_result();

    // Check if there are results
    if ($result->num_rows > 0) {
        // Initialize variables to keep track of the current order
        $currentOrderId = null;
        $productNames = array();
        $quantities = array();
        $totalPrice = 0; // Initialize total price
        $username = null;

        // Start the table structure and form
        echo "<form id='approveForm' method='POST' >";
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Product Name</th><th>Quantity</th><th>Total Price</th><th>Customer</th><th>Action</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            $orderId = $row['order_id'];
            
            // Check if this is a new order
            if ($orderId != $currentOrderId) {
                // Display the details for the previous order, if any
                if ($currentOrderId !== null) {
                ?>
                    <tr>
                        <td><?php echo $currentOrderId; ?></td>
                        <td><?php echo implode("<br>", $productNames); ?></td>
                        <td><?php echo implode("<br>", $quantities); ?></td>
                        <td><?php echo $totalPrice; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <button type="button" onclick='sendEmail("<?php echo $username; ?>")'>Approve</button>
                        </td>
                    </tr>
                    <tr><td colspan='6'><hr></td></tr>
                <?php
                }
                
                // Reset the arrays and total price for the new order
                $currentOrderId = $orderId;
                $productNames = array();
                $quantities = array();
                $totalPrice = $row['total_price'];
                $username = $row['username'];
            }

            // Add the product name and quantity to the arrays
            $productNames[] = $row['product_name'];
            $quantities[] = $row['quantity'];
        }

        // Display the details for the last order
        ?>
        <tr>
            <td><?php echo $currentOrderId; ?></td>
            <td><?php echo implode("<br>", $productNames); ?></td>
            <td><?php echo implode("<br>", $quantities); ?></td>
            <td><?php echo $totalPrice; ?></td>
            <td><?php echo $username; ?></td>
            <td>
                <button type="button" onclick='sendEmail("<?php echo $username; ?>")'>Approve</button>
            </td>
        </tr>
        <tr><td colspan='6'><hr></td></tr>
        <?php

        // Close the table structure and form
        echo "</table>";
        echo "</form>";
    } else {
        echo "No results found.";
    }

    $stmt->close();
    $conn->close();
    ?>
    
    <script>
        function sendEmail(customer) {
            // Define your company's email address as the sender
            const companyEmail = "suziemweshn@gmail.com";

            // Send an AJAX request to send_email.php
            $.post('send_email.php', { username: customer }, function(response) {
                const emailLinks = JSON.parse(response);

                if (emailLinks.approval_link) {
                    // Use your company's email address as the sender
                    const sender = companyEmail;

                    // Get the recipient's email address from the response
                    const recipient = emailLinks.approval_link.split(":")[1] || "";

                    // Construct the mailto link
                    const mailtoLink = `mailto:${recipient}${encodeURIComponent('Subject : AHF Order Approval')}&body=${encodeURIComponent('Dear Customer, ')}`;

                    // Open a new email window with the mailto link
                    window.open(mailtoLink);
                } else {
                    alert('Approval link not available.');
                }
            });
        }
    </script>
</body>
</html>
