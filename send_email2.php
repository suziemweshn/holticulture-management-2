<?php
session_start();
include  'conn.php';
// Check if the user is logged in
if (isset($_POST['username'])) {
    // Get the username
    $username = $_POST['username'];


// Retrieve user details from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Retrieve user profile details from the admin_table
$stmt = $conn->prepare("SELECT * FROM customer_table WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'] ?? '';
    $name=$row['name'] ?? '';
    $username = $row['username'] ?? '';
} else {
    // User not found in the admin_table
    // Handle the scenario accordingly, e.g., display an error message
    echo "User profile not found!";
}
}

$stmt->close();
$conn->close();
?>
<?php "mailto:<?php echo ($email); ?>?&subject=Subject : Smoby Grocers Order Approval&body=Dear <?php echo ($name); ?>, </td>
                <td><a href="mailto:<?php echo ($email); ?>?&subject=Subject : Smoby Grocers Order Decline&body=Dear <?php echo ($name); ?>, </td>>