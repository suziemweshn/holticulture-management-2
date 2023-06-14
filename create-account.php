<?php
session_start();

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

// Retrieve form data and sanitize inputs
$ADMIN_NAME = mysqli_real_escape_string($conn, $_POST['ADMIN_NAME']);
$ADMIN_ID = mysqli_real_escape_string($conn, $_POST['ADMIN_ID']);
$ROLE_ID = mysqli_real_escape_string($conn, $_POST['ROLE_ID']);
$USER_NAME = mysqli_real_escape_string($conn, $_POST['USER_NAME']);
$PASS_WORD = mysqli_real_escape_string($conn, $_POST['PASS_WORD']);
$company = mysqli_real_escape_string($conn, $_POST['company']);
$jobTitle = mysqli_real_escape_string($conn, $_POST['jobTitle']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$Phone = mysqli_real_escape_string($conn, $_POST['Phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$twitterProfile = mysqli_real_escape_string($conn, $_POST['twitterProfile']);
$instagramProfile = mysqli_real_escape_string($conn, $_POST['instagramProfile']);
$linkedinProfile = isset($_POST['linkedinProfile']) ? mysqli_real_escape_string($conn, $_POST['linkedinProfile']) : '';
$facebookProfile = isset($_POST['facebookProfile']) ? mysqli_real_escape_string($conn, $_POST['facebookProfile']) : '';
$about = isset($_POST['about']) ? mysqli_real_escape_string($conn, $_POST['about']) : '';
$Address = mysqli_real_escape_string($conn, $_POST['Address']);

// Hash the password
$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement with prepared statements
$stmt = $conn->prepare("INSERT INTO admin_table (ADMIN_NAME, ADMIN_ID, ROLE_ID, USER_NAME, PASS_WORD, company, jobTitle, country, Phone, email, twitterProfile, instagramProfile, linkedinProfile, facebookProfile, about, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param("ssssssssssssssss", $ADMIN_NAME, $ADMIN_ID, $ROLE_ID, $USER_NAME, $hashed_password, $company, $jobTitle, $country, $Phone, $email, $twitterProfile, $instagramProfile, $linkedinProfile, $facebookProfile, $about, $Address);

if ($stmt->execute()) {
    // Data inserted successfully, set session variables
    $_SESSION['USER_NAME'] = $USER_NAME;

    // Redirect to the profile page
    header("Location: pages-login.html");
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
