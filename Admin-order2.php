<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    
    <?php
    include 'conn.php'; // Include your database connection

    // Query to retrieve all available order_ids with concatenated product names and total_price
    $query = "SELECT oi.order_id, GROUP_CONCAT(oi.product_name) as product_names, tp.total_price
              FROM order_items oi
              JOIN (
                  SELECT order_id, total_price
                  FROM total_prices
              ) tp ON oi.order_id = tp.order_id
              GROUP BY oi.order_id";

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
        // Display the results in a table
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Product Names</th><th>Total Price</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['product_names'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No results found.";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
