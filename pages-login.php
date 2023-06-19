<?php
session_start(); // Start the session

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'project';
$port = '3307';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from the login form and sanitize it
$USER_NAME = trim($_POST['USER_NAME']);
$PASS_WORD = $_POST['PASS_WORD'];

// Prepare the query with placeholders to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
$stmt->bind_param("s", $USER_NAME);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_PASS_WORD = $row['PASS_WORD'];
    $ADMIN_ID = $row['ADMIN_ID']; // Assuming the column name is ADMIN_ID

    // Verify the password using password_verify
    if (password_verify($PASS_WORD, $stored_PASS_WORD)) {
        // Password is correct, set session variables
        $_SESSION['USER_NAME'] = $USER_NAME;
        $_SESSION['ADMIN_ID'] = $ADMIN_ID; // Set the ADMIN_ID session variable

        // Redirect to the profile page
        header("Location: profile.php");
        exit();
    } else {
        // Invalid password
        echo "Invalid password!";
    }
} else {
    // Invalid username
    echo "Invalid username!";
}

$stmt->close();
$conn->close();
?>
