<?php
include  'conn.php';
//$id = uniqid(); // Generate a unique ID for the admin
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$country= isset($_POST['country']) ? $_POST['country'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';

//hash the password
$hashed_password=password_hash($password, PASSWORD_DEFAULT);
//prepare and execute sql statements

$stmt=$conn->prepare("INSERT INTO Customer_table(id, name, email, phone_no, password, username, country, city, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt){
    echo "error preparing the statement:".$conn->connect_error;
    exit();
}
$stmt->bind_param(
    "sssssssss",
   $id,
   $name,
   $email,
   $phone_no,
   $hashed_password,
   $username,
   $country,
   $city,
   $location,
    
);

if ($stmt->execute()) {
    // Account created successfully, set session variables
    $_SESSION['username'] = $username;

    // Redirect to the login page
    header("Location: customer-login.php");
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>

?>