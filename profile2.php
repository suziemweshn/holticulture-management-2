<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['USER_NAME'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: pages-login.php');
    exit;
}

// Retrieve user details from the session
$USER_NAME = $_SESSION['USER_NAME'];

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

// Retrieve user profile details from the admin_table
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
$stmt->bind_param("s", $USER_NAME);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jobTitle = $row['jobTitle'];
    $company = $row['company'];
    $country = $row['country'];
    $address = $row['Address'];
    $phone = $row['Phone'];
    $email = $row['email'];
    $twitterProfile = $row['twitterProfile'];
    $instagramProfile = $row['instagramProfile'];
    $facebookProfile = $row['facebookProfile'];
    $linkedinProfile = $row['linkedinProfile'];
} else {
    // User not found in the admin_table
    // Handle the scenario accordingly, e.g., display an error message
    echo "User profile not found!";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $USER_NAME; ?></h1>
    <p>Job Title: <?php echo $jobTitle; ?></p>
    <p>Company: <?php echo $company; ?></p>
    <p>Country: <?php echo $country; ?></p>
    <p>Address: <?php echo $address; ?></p>
    <p>Phone: <?php echo $phone; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Twitter Profile: <a href="<?php echo $twitterProfile; ?>"><?php echo $twitterProfile; ?></a></p>
    <p>Instagram Profile: <a href="<?php echo $instagramProfile; ?>"><?php echo $instagramProfile; ?></a></p>
    <p>Facebook Profile: <a href="<?php echo $facebookProfile; ?>"><?php echo $facebookProfile; ?></a></p>
    <p>LinkedIn Profile: <a href="<?php echo $linkedinProfile; ?>"><?php echo $linkedinProfile; ?></a></p>
</body>
</html>
