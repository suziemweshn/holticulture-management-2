
<?php

session_start();

// Establish database connection
include  'conn.php';
// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['profileImage']['tmp_name'];
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/profile-pictures/';
    $fileName = basename($_FILES['profileImage']['name']);
    $targetFile = $targetDirectory . $fileName;

    // Get the image size and type
    $imageSize = getimagesize($tempFile);
    $originalWidth = $imageSize[0];
    $originalHeight = $imageSize[1];
    $imageType = $imageSize[2];

    // Check if the image type is supported
    $allowedExtensions = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    if (!in_array($imageType, $allowedExtensions)) {
        echo "Invalid file format. Only JPEG, PNG, and GIF images are allowed.";
        exit();
    }

    // Create the resized image with the desired width
    $desiredWidth = $originalWidth * 0.5;
    $desiredHeight = $originalHeight * ($desiredWidth / $originalWidth);
    $resizedImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    // Load the original image based on its type
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $originalImage = imagecreatefromjpeg($tempFile);
            break;
        case IMAGETYPE_PNG:
            $originalImage = imagecreatefrompng($tempFile);
            break;
        case IMAGETYPE_GIF:
            $originalImage = imagecreatefromgif($tempFile);
            break;
    }

    // Resize the original image to the desired dimensions
    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

    // Create a circular mask
    $mask = imagecreatetruecolor($desiredWidth, $desiredHeight);
    $maskTransparent = imagecolorallocate($mask, 255, 0, 0);
    imagecolortransparent($mask, $maskTransparent);
    imagefilledellipse($mask, $desiredWidth / 2, $desiredHeight / 2, $desiredWidth, $desiredHeight, $maskTransparent);
    imagecopymerge($resizedImage, $mask, 0, 0, 0, 0, $desiredWidth, $desiredHeight, 100);
    imagecolortransparent($resizedImage, $maskTransparent);
    imagefill($resizedImage, 0, 0, $maskTransparent);

    // Save the resized and masked image to the target directory
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, $targetFile);
            break;
        case IMAGETYPE_PNG:
            imagepng($resizedImage, $targetFile);
            break;
        case IMAGETYPE_GIF:
            imagegif($resizedImage, $targetFile);
            break;
    }

    // Destroy the images to free up memory
    imagedestroy($originalImage);
    imagedestroy($resizedImage);
    imagedestroy($mask);

    // Store the file path in session
    $_SESSION['profileImagePath'] = 'profile-pictures/' . $fileName;
    echo "Image uploaded and resized successfully!";
    
    // Update the profilePictureData field in the admin_table
    $profileImagePath = 'profile-pictures/' . $fileName;
    $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session

    $sql = "UPDATE admin_table SET profilePictureData = ? WHERE ADMIN_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $profileImagePath, $ADMIN_ID);
    
    if ($stmt->execute()) {
        echo "Profile picture path stored in the database.";
    } else {
        echo "Error updating profile picture path: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
} else {
    echo "Error uploading the image.";
}

// Generate the profile page
function generateProfilePage() {
    global $conn; // Access the database connection inside the function

    // Check if the profile image path is set in session
    if (isset($_SESSION['profileImagePath'])) {
        $profileImagePath = $_SESSION['profileImagePath'];
        echo '<img id="profileImg" src="' . $profileImagePath . '" alt="Profile">';
    } else {
        // Fetch the profilePictureData field from the admin_table
        $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session
        $sql = "SELECT profilePictureData FROM admin_table WHERE ADMIN_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ADMIN_ID);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $profilePictureData = $row['profilePictureData'];
                echo '<img id="profileImg" src="' . $profilePictureData . '" alt="Profile">';
            } else {
                echo '<img id="profileImg" src="assets/img/profile-img.jpg" alt="Profile">';
            }
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

?>
<?php
/*session_start();

// Establish database connection
$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = "project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['profileImage']['tmp_name'];
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/profile-pictures/';
    $fileName = basename($_FILES['profileImage']['name']);
    $targetFile = $targetDirectory . $fileName;

    // Get the image size and type
    $imageSize = getimagesize($tempFile);
    $originalWidth = $imageSize[0];
    $originalHeight = $imageSize[1];
    $imageType = $imageSize[2];

    // Check if the image type is supported
    $allowedExtensions = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    if (!in_array($imageType, $allowedExtensions)) {
        echo "Invalid file format. Only JPEG, PNG, and GIF images are allowed.";
        exit();
    }

    // Create the resized image with the desired width
    $desiredWidth = $originalWidth * 0.5;
    $desiredHeight = $originalHeight * ($desiredWidth / $originalWidth);
    $resizedImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    // Load the original image based on its type
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $originalImage = imagecreatefromjpeg($tempFile);
            break;
        case IMAGETYPE_PNG:
            $originalImage = imagecreatefrompng($tempFile);
            break;
        case IMAGETYPE_GIF:
            $originalImage = imagecreatefromgif($tempFile);
            break;
    }

    // Resize the original image to the desired dimensions
    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

    // Create a circular mask
    $mask = imagecreatetruecolor($desiredWidth, $desiredHeight);
    $maskTransparent = imagecolorallocate($mask, 255, 0, 0);
    imagecolortransparent($mask, $maskTransparent);
    imagefilledellipse($mask, $desiredWidth / 2, $desiredHeight / 2, $desiredWidth, $desiredHeight, $maskTransparent);
    imagecopymerge($resizedImage, $mask, 0, 0, 0, 0, $desiredWidth, $desiredHeight, 100);
    imagecolortransparent($resizedImage, $maskTransparent);
    imagefill($resizedImage, 0, 0, $maskTransparent);

    // Save the resized and masked image to the target directory
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, $targetFile);
            break;
        case IMAGETYPE_PNG:
            imagepng($resizedImage, $targetFile);
            break;
        case IMAGETYPE_GIF:
            imagegif($resizedImage, $targetFile);
            break;
    }

    // Destroy the images to free up memory
    imagedestroy($originalImage);
    imagedestroy($resizedImage);
    imagedestroy($mask);

    // Store the file path in session
    $_SESSION['profileImagePath'] = 'profile-pictures/' . $fileName;
    echo "Image uploaded and resized successfully!";
    
    // Update the profilePictureData field in the admin_table
    $profileImagePath = 'profile-pictures/' . $fileName;
    $ADMIN_ID = $_SESSION['ADMIN_ID']; 

    $sql = "UPDATE admin_table SET profilePictureData = '$profileImagePath' WHERE ADMIN_ID = $ADMIN_ID";
    if ($conn->query($sql) === TRUE) {
        echo "Profile picture path stored in the database.";
    } else {
        echo "Error updating profile picture path: " . $conn->error;
    }
} else {
    echo "Error uploading the image.";
}

// Generate the profile page
function generateProfilePage() {
    global $conn; // Access the database connection inside the function

    // Check if the profile image path is set in session
    if (isset($_SESSION['profileImagePath'])) {
        $profileImagePath = $_SESSION['profileImagePath'];
        echo '<img id="profileImg" src="' . $profileImagePath . '" alt="Profile">';
    } else {
        // Fetch the profilePictureData field from the admin_table
        $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session
        $sql = "SELECT profilePictureData FROM admin_table WHERE ADMIN_ID = $ADMIN_ID";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profilePictureData = $row['profilePictureData'];
            echo '<img id="profileImg" src="' . $profilePictureData . '" alt="Profile">';
        } else {
            echo '<img id="profileImg" src="assets/img/profile-img.jpg" alt="Profile">';
        }
    }
}

?>

<?php
/*session_start();

// Establish database connection
$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = "project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['profileImage']['tmp_name'];
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/profile-pictures/';
    $fileName = basename($_FILES['profileImage']['name']);
    $targetFile = $targetDirectory . $fileName;

    // Get the image size and type
    $imageSize = getimagesize($tempFile);
    $originalWidth = $imageSize[0];
    $originalHeight = $imageSize[1];
    $imageType = $imageSize[2];

    // Check if the image type is supported
    $allowedExtensions = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    if (!in_array($imageType, $allowedExtensions)) {
        echo "Invalid file format. Only JPEG, PNG, and GIF images are allowed.";
        exit();
    }

    // Create the resized image with the desired width
    $desiredWidth = $originalWidth * 0.5;
    $desiredHeight = $originalHeight * ($desiredWidth / $originalWidth);
    $resizedImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    // Load the original image based on its type
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $originalImage = imagecreatefromjpeg($tempFile);
            break;
        case IMAGETYPE_PNG:
            $originalImage = imagecreatefrompng($tempFile);
            break;
        case IMAGETYPE_GIF:
            $originalImage = imagecreatefromgif($tempFile);
            break;
    }

    // Resize the original image to the desired dimensions
    imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);

    // Create a circular mask
    $mask = imagecreatetruecolor($desiredWidth, $desiredHeight);
    $maskTransparent = imagecolorallocate($mask, 255, 0, 0);
    imagecolortransparent($mask, $maskTransparent);
    imagefilledellipse($mask, $desiredWidth / 2, $desiredHeight / 2, $desiredWidth, $desiredHeight, $maskTransparent);
    imagecopymerge($resizedImage, $mask, 0, 0, 0, 0, $desiredWidth, $desiredHeight, 100);
    imagecolortransparent($resizedImage, $maskTransparent);
    imagefill($resizedImage, 0, 0, $maskTransparent);

    // Save the resized and masked image to the target directory
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($resizedImage, $targetFile);
            break;
        case IMAGETYPE_PNG:
            imagepng($resizedImage, $targetFile);
            break;
        case IMAGETYPE_GIF:
            imagegif($resizedImage, $targetFile);
            break;
    }

    // Destroy the images to free up memory
    imagedestroy($originalImage);
    imagedestroy($resizedImage);
    imagedestroy($mask);

    // Store the file path in session
    $_SESSION['profileImagePath'] = 'profile-pictures/' . $fileName;
    echo "Image uploaded and resized successfully!";
    
    // Update the profilePictureData field in the admin_table
    $profileImagePath = 'profile-pictures/' . $fileName;
    $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session

    $sql = "UPDATE admin_table SET profilePictureData = '$profileImagePath' WHERE ADMIN_ID = $ADMIN_ID";
    if ($conn->query($sql) === TRUE) {
        echo "Profile picture path stored in the database.";
    } else {
        echo "Error updating profile picture path: " . $conn->error;
    }
} else {
    echo "Error uploading the image.";
}

   
// Generate the profile page
function generateProfilePage() {
    // Check if the profile image path is set in session
    if (isset($_SESSION['profileImagePath'])) {
        $profileImagePath = $_SESSION['profileImagePath'];
        echo '<img id="profileImg" src="' . $profileImagePath . '" alt="Profile">';
    } else {
        // Fetch the profilePictureData field from the admin_table
        $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session
        $sql = "SELECT profilePictureData FROM admin_table WHERE ADMIN_ID = $ADMIN_ID";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profilePictureData = $row['profilePictureData'];
            echo '<img id="profileImg" src="' . $profilePictureData . '" alt="Profile">';
        } else {
            echo '<img id="profileImg" src="assets/img/profile-img.jpg" alt="Profile">';
        }
    }
}
?>*/
