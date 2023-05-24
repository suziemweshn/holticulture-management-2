<?php
session_start(); // Start the session

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'Project';
$port = '3307';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from the login form
$USER_NAME = $_POST['USER_NAME'];
$PASS_WORD = $_POST['PASS_WORD'];

// Prepare the query
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
$stmt->bind_param("s", $USER_NAME);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_PASS_WORD = $row['PASS_WORD'];
    
    // Verify the password using password_verify
    if (password_verify($PASS_WORD, $stored_PASS_WORD)) {
        // Password is correct, set session variables
        $_SESSION['USER_NAME'] = $USER_NAME;
        
        // Redirect to the admin page
        header("Location: profile.html");
        exit();
    } else {
        echo "Invalid username or password!";
    }
} else {
    echo "Invalid username or password!";
}

$stmt->close();
$conn->close();
?>
