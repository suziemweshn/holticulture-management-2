<?php
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

// Retrieve form data
$ADMIN_NAME = $_POST['ADMIN_NAME'];
$ADMIN_ID = $_POST['ADMIN_ID'];
$ROLE_ID = $_POST['ROLE_ID'];
$USER_NAME = $_POST['USER_NAME'];
$PASS_WORD = $_POST['PASS_WORD'];

// Hash the password
$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement
$sql = "INSERT INTO admin_table (ADMIN_NAME, ADMIN_ID, ROLE_ID, USER_NAME, PASS_WORD) VALUES ('$ADMIN_NAME', '$ADMIN_ID', '$ROLE_ID', '$USER_NAME', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
