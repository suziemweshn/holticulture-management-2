<?php
session_start();
include 'conn.php';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user profile details from the payment
$stmt = $conn->prepare("SELECT * FROM payment WHERE username = ?");
if (!$stmt) {
    die("Error in preparing the statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();

if ($stmt->errno) {
    die("Error in executing the statement: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'] ?? '';
    $username = $row['username'] ?? '';
    $phone_no = $row['phone_no'] ?? '';
   
    $paymentOption = $row['payment_option'] ?? '';
    $payment_amount = $row['payment_amount'] ?? '';
    $payment_date = $row['payment_date'] ?? '';
    $payment_status = $row['payment_status'] ?? '';

    // Retrieve order_id from order_items associated with the username
    $totalPricesStmt = $conn->prepare("SELECT order_id FROM order_items WHERE username = ?");
    $totalPricesStmt->bind_param("s", $username);
    $totalPricesStmt->execute();
    $totalPricesResult = $totalPricesStmt->get_result();
    
    if ($totalPricesResult->num_rows > 0) {
        $totalPricesRow = $totalPricesResult->fetch_assoc();
        $order_id = $totalPricesRow['order_id'] ?? '';
    } else {
        // No order_id found for the user
        $order_id = 'N/A';
    }
} else {
    // User not found in the payment
    // Handle the scenario accordingly, e.g., display an error message
    echo "User profile not found!";
}

$stmt->close();


// Initialize variables to store form data
//$name = $email = $phone_no = $alt_phone_number = $address = $country = $city = $location = '';
//$deliveryOption = $selectedAgent = $agentNumber = $gender = $contactNumber = '';
//$paymentOption = $payment_amount = $payment_date = $payment_status = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = $_POST['name'];
  //  $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $paymentOption = $_POST['paymentOption'];
    $payment_amount = $_POST['payment_amount'];
    $payment_date = $_POST['payment_date'];
    $payment_status = $_POST['payment_status'];
    $order_id = $_POST['order_id'];

    // Store the form data in the Admin_payment table
    $insertStmt = $conn->prepare("INSERT INTO Admin_payment (name, username, order_id, phone_no, paymentOption, payment_amount, payment_date, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insertStmt->bind_param("ssisssss", $name, $username, $order_id, $phone_no, $paymentOption, $payment_amount, $payment_date, $payment_status);
    
    if ($insertStmt->execute()) {
        // Data has been successfully inserted
        echo "Data has been saved successfully!";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $insertStmt->error;
    }

    $insertStmt->close();
}

// Retrieve user details from the session

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Payment Management</h1>
<form method="POST" action="Admin-payment.php">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>order_id</th>
               
                
                <th>Payment Option</th>
                <th>Payment Amount</th>
                <th>Payment Date</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="name" value="<?php echo $name; ?>" readonly></td>
                <td><input type="email" name="username" value="<?php echo $username; ?>"readonly></td>
                <td><input type="text" name="phone_no" value="<?php echo $phone_no; ?>"readonly></td>
                <td><input type="text" name="order_id" value="<?php echo $order_id; ?>"readonly></td>
               
                
                <td><input type="text" name="paymentOption" value="<?php echo $paymentOption; ?>"readonly></td>
                <td><input type="text" name="payment_amount" value="<?php echo $payment_amount; ?>"readonly></td>
                <td><input type="date" name="payment_date" value="<?php echo $payment_date; ?>"></td>
                <td>
                    <select name="payment_status" id="status">
                        <option value="0">Select Status</option>
                        <option value="1" <?php if ($payment_status === '1') echo 'selected'; ?>>Paid</option>
                        <option value="2" <?php if ($payment_status === '2') echo 'selected'; ?>>Unpaid</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="submit" value="Save">
</form>
</body>
</html>
