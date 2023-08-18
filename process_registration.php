<?php
// Assuming you have a database connection established
include 'conn.php' ;


$username = $_POST['username'];
$role = $_POST['role'];

$query = "INSERT INTO users (username, role) VALUES ('$username', '$role')";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
