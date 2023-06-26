<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['USER_NAME'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: pages-login.html');
    exit;
}

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'Project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from the session
$ADMIN_ID = $_SESSION['ADMIN_ID'] ?? '';

// Get the notification settings values from the form
$changesMade = isset($_POST['changesMade']) ? 1 : 0;
$newProducts = isset($_POST['newProducts']) ? 1 : 0;

// Prepare the update query
$stmt = $conn->prepare("UPDATE update_notifications SET changesMade = ?, newProducts = ? WHERE ADMIN_ID = ?");
$stmt->bind_param("iii", $changesMade, $newProducts, $userID);

if ($stmt->execute()) {
    // Update successful
    $_SESSION['success_message'] = "Notification settings updated successfully.";
} else {
    // Update failed
    $_SESSION['error_message'] = "Error updating notification settings: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back to the profile page
header('Location: profile.php');
exit;
?>
