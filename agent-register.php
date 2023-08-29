<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

include  'conn.php';

// Retrieve the form data for account creation
$id=uniqid();
$Agent_name = isset($_POST['Agent_name']) ? $_POST['Agent_name'] : '';
$Agent_Number = isset($_POST['Agent_Number']) ? $_POST['Agent_Number'] : '';
$Contact_Number= isset($_POST['Contact_Number']) ? $_POST['Contact_Number'] : '';
$Emergency_Contact= isset($_POST['Emergency_Contact']) ? $_POST['Emergency_Contact'] : '';
$Email_Address = isset($_POST['Email_Address']) ? $_POST['Email_Address'] : '';
$Date_of_Birth = isset($_POST['Date_of_Birth']) ? $_POST['Date_of_Birth'] : '';
$Address_name = isset($_POST['Address_name']) ? $_POST['Address_name'] : '';
$Country = isset($_POST['Country']) ? $_POST['Country'] : '';
$City = isset($_POST['City']) ? $_POST['City'] : '';
$Location = isset($_POST['Location']) ? $_POST['Location'] : '';
$Gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';

// Hash the password
//$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Process account creation request
// Prepare and execute the SQL statement with prepared statements
$stmt = $conn->prepare("INSERT INTO agent (Agent_name, Agent_Number, Contact_Number,Emergency_Contact, Email_Address, Date_of_Birth, Address_name, Country, City, Location,Gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param(
    "sssssssssss",
   
   $Agent_name,
   $Agent_Number,
   $Contact_Number,
   $Emergency_Contact,
   $Email_Address,
   $Date_of_Birth,
   $Address_name,
   $Country,
   $City,
   $Location,
   $Gender,
);

if ($stmt->execute()) {
    // Account created successfully, set session variables
    $_SESSION['id'] = $id;

    // Redirect to the login page
   echo('user registered successfully');
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>



