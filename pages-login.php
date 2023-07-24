<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



$servername = "localhost:3307";
$username = "root";
$password = '1234';
$database = 'Project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data for login
$USER_NAME = isset($_POST['USER_NAME']) ? $_POST['USER_NAME'] : '';
$PASS_WORD = isset($_POST['PASS_WORD']) ? $_POST['PASS_WORD'] : '';

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
            $_SESSION['ADMIN_ID'] = $row['ADMIN_ID'];
            $_SESSION['USER_NAME'] = $USER_NAME;

            // Redirect to the profile page or wherever you want
            header("Location: profile.php");
            exit();
        } else {
            // Invalid password
          //  header("Location: pages-login.html?error=invalid");
           // exit();
           echo("log in unsuccessful");
        }
    } else {
        // User does not exist
        header("Location: pages-login.html?error=notfound");
        exit();
    }
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

session_start(); // Start the session

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from the login form and sanitize it
$USER_NAME = trim($_POST['USER_NAME'] ?? '');
$PASS_WORD = $_POST['PASS_WORD'] ?? '';

// Prepare the query with placeholders to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
$stmt->bind_param("s", $USER_NAME);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $PASS_WORD = $row['PASS_WORD'];
    $ADMIN_ID = $row['ADMIN_ID'];

    // Verify the password using password_verify
    if (password_verify($PASS_WORD, $PASS_WORD)){
        // Password is correct, set session variables
        $_SESSION['USER_NAME'] = $USER_NAME;
        $_SESSION['ADMIN_ID'] = $ADMIN_ID; // Set the ADMIN_ID session variable

        // Redirect to the profile page
        header("Location: profile.php");
        exit();
    } else {
        // Invalid password
        echo "Invalid username or password!";
    }
} else {
    // User does not exist
    echo "Invalid username or password!";
}

$stmt->close();
$conn->close();
?>*/
