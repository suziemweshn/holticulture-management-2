<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

var_dump($_POST);

$servername = "localhost:3307";
$username = "root";
$password = '1234';
$database = 'project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from the session
$ADMIN_ID = $_SESSION['ADMIN_ID'] ?? '';

// Get the form input values
$ADMIN_NAME = $_POST['ADMIN_NAME'] ?? '';
$about = $_POST['about'] ?? '';
$company = $_POST['company'] ?? '';
$jobTitle = $_POST['jobTitle'] ?? '';
$country = $_POST['country'] ?? '';
$Address = $_POST['Address'] ?? '';
$Phone = $_POST['Phone'] ?? '';
$email = $_POST['email'] ?? '';
$twitterProfile = $_POST['twitterProfile'] ?? '';
$facebookProfile = $_POST['facebookProfile'] ?? '';
$instagramProfile = $_POST['instagramProfile'] ?? '';
$linkedinProfile = $_POST['linkedinProfile'] ?? '';
$USER_NAME=$_POST['USER_NAME']?? '';

var_dump($ADMIN_ID);
var_dump($ADMIN_NAME);
var_dump($about);
var_dump($email);
var_dump($country);
var_dump($company);
var_dump($jobTitle);
var_dump($Phone);
var_dump($Address);
var_dump($twitterProfile);
var_dump($facebookProfile);
var_dump($instagramProfile);
var_dump($linkedinProfile);




// Prepare the update query
$stmt = $conn->prepare("UPDATE admin_table SET ADMIN_NAME = ?, about = ?, company = ?, jobTitle = ?, country = ?, Address = ?, Phone = ?, USER_NAME = ?,  email = ?, twitterProfile = ?, facebookProfile = ?, instagramProfile = ?, linkedinProfile = ? WHERE ADMIN_ID = ?");
if ($stmt === false) {
    echo "Error preparing the update query: " . $conn->error;
    exit;
}

// Bind the parameters to the statement
$stmt->bind_param("ssssssissssssi", $ADMIN_NAME, $about, $company, $jobTitle, $country, $Address, $Phone, $USER_NAME, $email, $twitterProfile, $facebookProfile, $instagramProfile, $linkedinProfile, $ADMIN_ID);


// Execute the statement
if ($stmt->execute()) {
    // Update successful
    $_SESSION['success_message'] = "Profile changes updated successfully.";
    //update the changes made
    $_SESSION['ADMIN_NAME']=$ADMIN_NAME;
    $_SESSION['about']=$about;
    $_SESSION['company']=$company;
    $_SESSION['jobTitle']=$jobTitle;
    $_SESSION['country']=$country;
    $_SESSION['Address']=$Address;
    $_SESSION['Phone']=$Phone;
    $_SESSION['email']=$email;
    $_SESSION['twitterProfile']=$twitterProfile;
    $_SESSION['facebookProfile']=$facebookProfile;
    $_SESSION['instagramProfile']=$instagramProfile;
    $_SESSION['linkedinProfile']=$linkedinProfile;
    $_SESSION['USER_NAME']=$USER_NAME;


    echo 'done';


} else {
    // Update failed
    echo "Error executing the update query: " . $stmt->error;
    $_SESSION['error_message'] = "Error updating the profile changes: " . $stmt->error;
}

$stmt->close();
$conn->close();

exit;


// Prepare the update query
/*$stmt = $conn->prepare("UPDATE admin_table SET ADMIN_NAME = ?, about = ?, company = ?, jobTitle = ?, country = ?, Address = ?, Phone = ?, email = ?, twitterProfile = ?, facebookProfile = ?, instagramProfile = ?, linkedinProfile = ?, WHERE ADMIN_ID = ?");
/*$stmt->bind_param("ssssssssssss", $ADMIN_NAME, $about, $company, $jobTitle, $country, $Address, $Phone, $email, $twitterProfile, $facebookProfile, $instagramProfile, $linkedinProfile, $ADMIN_ID);
$stmt->bind_param("sssssssssssssi", $ADMIN_NAME, $about, $company, $jobTitle, $country, $Address, $Phone, $email, $twitterProfile, $facebookProfile, $instagramProfile, $linkedinProfile, $ADMIN_ID);


if ($stmt->execute()) {
    // Update successful
    $_SESSION['success_message'] = "Profile changes updated successfully.";
} else {
    // Update failed
    $_SESSION['error_message'] = "Error updating the profile changes: " . $stmt->error;
}

$stmt->close();
$conn->close();


exit;
?>


<?php
/*session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost:3307";
$username = "root";
$password = '1234';
$database = 'project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from the session
$ADMIN_ID = $_SESSION['ADMIN_ID'] ?? '';

// Get the form input values
$ADMIN_NAME = $_POST['ADMIN_NAME'] ?? '';
$about = $_POST['about'] ?? '';
$company = $_POST['company'] ?? '';
$jobTitle = $_POST['jobTitle'] ?? '';
$country = $_POST['country'] ?? '';
$Address = $_POST['Address'] ?? '';
$Phone = $_POST['Phone'] ?? '';
$email = $_POST['email'] ?? '';
$twitterProfile = $_POST['twitterProfile'] ?? '';
$facebookProfile = $_POST['facebookProfile'] ?? '';
$instagramProfile = $_POST['instagramProfile'] ?? '';
$linkedinProfile = $_POST['linkedinProfile'] ?? '';
var_dump($ADMIN_ID);

// Prepare the update query
$stmt = $conn->prepare("UPDATE admin_table SET ADMIN_NAME = ?, about = ?, company = ?, jobTitle = ?, country = ?, Address = ?, Phone = ?, email = ?, twitterProfile = ?, facebookProfile = ?, instagramProfile = ?, linkedinProfile = ? WHERE ADMIN_ID = ?");
$stmt->bind_param("sssssssssssss", $ADMIN_NAME, $about, $company, $jobTitle, $country, $Address, $Phone, $email, $twitterProfile, $facebookProfile, $instagramProfile, $linkedinProfile, $ADMIN_ID);

if ($stmt->execute()) {
    // Update successful
    $_SESSION['success_message'] = "Profile changes updated successfully.";

    // Update the session values with the new notification settings
    /* $_SESSION['changesMade'] = $changesMade;
    $_SESSION['newProducts'] = $newProducts;
} else {
    // Update failed
    echo "Error executing the update query: " . $stmt->error;
    $_SESSION['error_message'] = "Error updating the profile changes: " . $stmt->error;
}

$stmt->close();
$conn->close();

exit;

?>*/
