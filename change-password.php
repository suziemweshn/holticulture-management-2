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

// Get the form input values
$currentPassword = $_POST['currentPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$renewPassword = $_POST['renewPassword'] ?? '';

// Validate the input
if ($newPassword !== $renewPassword) {
    $_SESSION['error_message'] = "New passwords do not match.";
    header('Location: profile.php');
    exit;
}

// Encrypt the new password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Prepare and execute the update query
$stmt = $conn->prepare("UPDATE admin_table SET PASS_WORD = ? WHERE ADMIN_ID = ?");
$stmt->bind_param("si", $hashedPassword, $ADMIN_ID);

if ($stmt->execute()) {
    // Password update successful
    $_SESSION['success_message'] = "Password changed successfully.";
} else {
    // Password update failed
    $_SESSION['error_message'] = "Error updating password: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back to the profile page
header('Location: pages-login.html');
exit;
?>
