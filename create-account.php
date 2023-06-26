
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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

// Retrieve the form data for account creation
$ADMIN_ID = uniqid(); // Generate a unique ID for the admin
$USER_NAME = isset($_POST['USER_NAME']) ? $_POST['USER_NAME'] : '';
$PASS_WORD = isset($_POST['PASS_WORD']) ? $_POST['PASS_WORD'] : '';
$company = isset($_POST['company']) ? $_POST['company'] : '';
$jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$twitterProfile = isset($_POST['twitterProfile']) ? $_POST['twitterProfile'] : '';
$instagramProfile = isset($_POST['instagramProfile']) ? $_POST['instagramProfile'] : '';
$linkedinProfile = isset($_POST['linkedinProfile']) ? $_POST['linkedinProfile'] : '';
$facebookProfile = isset($_POST['facebookProfile']) ? $_POST['facebookProfile'] : '';
$Address = isset($_POST['Address']) ? $_POST['Address'] : '';
$ADMIN_NAME = isset($_POST['ADMIN_NAME']) ? $_POST['ADMIN_NAME'] : '';
$ROLE_ID = isset($_POST['ROLE_ID']) ? $_POST['ROLE_ID'] : '';

// Hash the password
$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Process account creation request
// Prepare and execute the SQL statement with prepared statements
$stmt = $conn->prepare("INSERT INTO admin_table (ADMIN_ID, USER_NAME, PASS_WORD, company, jobTitle, country, Phone, email, twitterProfile, instagramProfile, linkedinProfile, facebookProfile, about, Address, ADMIN_NAME, ROLE_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param(
    "ssssssssssssssss",
    $ADMIN_ID,
    $USER_NAME,
    $hashed_password,
    $company,
    $jobTitle,
    $country,
    $Phone,
    $email,
    $twitterProfile,
    $instagramProfile,
    $linkedinProfile,
    $facebookProfile,
    $about,
    $Address,
    $ADMIN_NAME,
    $ROLE_ID
);

if ($stmt->execute()) {
    // Account created successfully, set session variables
    $_SESSION['USER_NAME'] = $USER_NAME;

    // Redirect to the login page
    header("Location: pages-login.html");
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>

<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
}<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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

// Retrieve the form data for account creation
$ADMIN_ID = uniqid(); // Generate a unique ID for the admin
$USER_NAME = isset($_POST['USER_NAME']) ? $_POST['USER_NAME'] : '';
$PASS_WORD = isset($_POST['PASS_WORD']) ? $_POST['PASS_WORD'] : '';
$company = isset($_POST['company']) ? $_POST['company'] : '';
$jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$twitterProfile = isset($_POST['twitterProfile']) ? $_POST['twitterProfile'] : '';
$instagramProfile = isset($_POST['instagramProfile']) ? $_POST['instagramProfile'] : '';
$linkedinProfile = isset($_POST['linkedinProfile']) ? $_POST['linkedinProfile'] : '';
$facebookProfile = isset($_POST['facebookProfile']) ? $_POST['facebookProfile'] : '';
$Address = isset($_POST['Address']) ? $_POST['Address'] : '';
$ADMIN_NAME = isset($_POST['ADMIN_NAME']) ? $_POST['ADMIN_NAME'] : '';
$ROLE_ID = isset($_POST['ROLE_ID']) ? $_POST['ROLE_ID'] : '';

// Hash the password
$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Process account creation request
// Prepare and execute the SQL statement with prepared statements
$stmt = $conn->prepare("INSERT INTO admin_table (ADMIN_ID, USER_NAME, PASS_WORD, company, jobTitle, country, Phone, email, twitterProfile, instagramProfile, linkedinProfile, facebookProfile, about, Address, ADMIN_NAME, ROLE_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$stmt->bind_param(
    "ssssssssssssssss",
    $ADMIN_ID,
    $USER_NAME,
    $hashed_password,
    $company,
    $jobTitle,
    $country,
    $Phone,
    $email,
    $twitterProfile,
   



// Retrieve the form data for login or account creation
$USER_NAME = isset($_POST['USER_NAME']) ? $_POST['USER_NAME'] : '';
$PASS_WORD = isset($_POST['PASS_WORD']) ? $_POST['PASS_WORD'] : '';
$company = isset($_POST['company']) ? $_POST['company'] : '';
$jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$twitterProfile = isset($_POST['twitterProfile']) ? $_POST['twitterProfile'] : '';
$instagramProfile = isset($_POST['instagramProfile']) ? $_POST['instagramProfile'] : '';
$linkedinProfile = isset($_POST['linkedinProfile']) ? $_POST['linkedinProfile'] : '';
$facebookProfile = isset($_POST['facebookProfile']) ? $_POST['facebookProfile'] : '';
$Address = isset($_POST['Address']) ? $_POST['Address'] : '';
$ADMIN_NAME = isset($_POST['ADMIN_NAME']) ? $_POST['ADMIN_NAME'] : '';
$ROLE_ID = isset($_POST['ROLE_ID']) ? $_POST['ROLE_ID'] : '';

// Other profile details

// Hash the password
$hashed_password = password_hash($PASS_WORD, PASSWORD_DEFAULT);

// Check if it's a login or account creation request
if (isset($_POST['login'])) {
    // Process login request
    // Prepare and execute the SQL statement with prepared statements
    $stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
    $stmt->bind_param("s", $USER_NAME);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($PASS_WORD, $row['PASS_WORD'])) {
                // Login successful, set session variables
                $_SESSION['USER_NAME'] = $USER_NAME;

                // Redirect to the profile page or wherever you want
                header("Location: pages-login.php");
                exit();
            } else {
                // Invalid password
                header("Location: pages-login.php?error=invalid");
                exit();
            }
        } else {
            // User does not exist
            header("Location: pages-register.html?error=notfound");
            exit();
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} elseif (isset($_POST['createAccount'])) {
    // Process account creation request
    // Prepare and execute the SQL statement with prepared statements
    $stmt = $conn->prepare("INSERT INTO admin_table (USER_NAME, PASS_WORD, company, jobTitle, country, Phone, email, twitterProfile, instagramProfile, linkedinProfile, facebookProfile, about, Address, ADMIN_NAME, ROLE_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param(
        "sssssssssssssss",
        $USER_NAME,
        $hashed_password,
        $company,
        $jobTitle,
        $country,
        $Phone,
        $email,
        $twitterProfile,
        $instagramProfile,
        $linkedinProfile,
        $facebookProfile,
        $about,
        $Address,
        $ADMIN_NAME,
        $ROLE_ID
    );

    if ($stmt->execute()) {
        // Account created successfully, set session variables
        $_SESSION['USER_NAME'] = $USER_NAME;

        // Redirect to the profile page or wherever you want
        header("Location: pages-login.html");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Invalid request
  echo "details not registered:";
    exit();
}

// Close connection
$conn->close();*/

