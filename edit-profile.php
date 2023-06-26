<?php
$servername="localhost:3307";
$username="root";
$password='1234';
$database='project';

//create connection
$conn=new mysqli($servername, $username, $password, $database);

//check connection
if($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

//Retrieve user ID from the session
$ADMIN_ID=$_SESSION['ADMIN_ID'] ?? '';

//GET The form input values
$ADMIN_NAME=$_POST['ADMIN_NAME'] ?? '';
$about=$_POST['about'] ?? '';
$company=$_POST['company'] ?? '';
$jobTitle=$_POST['jobTitle'] ?? '';
$country=$_POST['country'] ?? '';
$Address=$_POST['Address'] ?? '';
$Phone=$_POST['Phone'] ?? '';
$email=$_POST['email'] ?? '';
$twitterProfile=$_POST['twitterProfile'] ?? '';
$facebookProfile=$_POST['facebookProfile'] ?? '';
$instagramProfile=$_POST['instagramProfile'] ?? '';
$linkedinProfile=$_POST['linkedinProfile'] ?? '';

//Prepare the update query
$stmt = $conn->prepare("UPDATE admin_table SET ADMIN_NAME = ?, about = ?, company = ?, jobTitle = ?, country = ?, Address = ?, Phone = ?, email = ?, twitterProfile = ?, facebookProfile = ?, instagramProfile = ?, linkedinProfile = ? WHERE ADMIN_ID = ?");
$stmt->bind_param("ssssssisssssi", $ADMIN_NAME, $about, $company, $jobTitle, $country, $Address, $Phone, $email, $twitterProfile, $facebookProfile, $instagramProfile, $linkedinProfile, $ADMIN_ID);

if ($stmt->execute()) {
    // Update successful
    $_SESSION['success_message'] = "profile changes updated successfully.";

    // Update the session values with the new notification settings
   /* $_SESSION['changesMade'] = $changesMade;
    $_SESSION['newProducts'] = $newProducts;*/
} else {
    // Update failed
    $_SESSION['error_message'] = "Error updating the profile changes: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back to the profile page
header('Location: profile.php');
exit;
?>

