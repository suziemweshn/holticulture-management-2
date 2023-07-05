<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'Products';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $tempFilePath = $_FILES['image']['tmp_name'];

    // Check if an image was uploaded
    if (!empty($image) && !empty($tempFilePath)) {
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/product-images/';
        $targetFile = $targetDirectory . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($tempFilePath);
        if ($check === false) {
            die('Error: File is not an image.');
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            die('Error: File already exists.');
        }

        // Check file size
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            die('Error: File size exceeds the maximum limit.');
        }

        // Allow only specific image file formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            die('Error: Only JPG, JPEG, PNG, and GIF formats are allowed.');
        }

        // Move the uploaded image to the product-images folder
        if (!move_uploaded_file($tempFilePath, $targetFile)) {
            die('Error: Failed to upload the file.');
        }
    } else {
        die('Error: No image file was uploaded.');
    }

    // Insert the product into the products table
    $query = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
    mysqli_query($conn, $query);

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the admin page or display success message
    header('Location: product-admin.php');
    exit();
}

// Retrieve products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
/*$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
*/
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (!array_key_exists('image', $row) || $row['image'] === null) {
        // The "image" field is not present or null in the result set
        echo "Warning: Image field is missing or null in the database row.";
        var_dump($row); // Debugging statement
        continue;
    }

    // Add the row to the products array
    $products[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Admin Page HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Page</h1>

    <!-- Add Product Form -->
    <form method="POST" action="product-admin.php" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br><br>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" required><br><br>

        <input type="submit" value="Add Product">
    </form>

    <!-- Display Products -->
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" width="100">
                        <?php else: ?>
                            No Image Available
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
