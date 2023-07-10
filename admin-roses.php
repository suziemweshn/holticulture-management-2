<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'products';

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
        //if (file_exists($targetFile)) {
          //  die('Error: File already exists.');
        //}

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
    $query = "INSERT INTO roses (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
    mysqli_query($conn, $query);
   


    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the admin page or display success message
    header('Location: Roses-admin.php');
    exit();
}

// Retrieve products from the database
$query = "SELECT * FROM roses";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
/*$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
*/
$roses = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (!array_key_exists('image', $row) || $row['image'] === null) {
        // The "image" field is not present or null in the result set
        echo "Warning: Image field is missing or null in the database row.";
        var_dump($row); // Debugging statement
        continue;
    }

    // Add the row to the products array
    $roses[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Admin Page HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="css/task6.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="heading mt-20 mb-20">
    <h3 >Admin Flower Page</h3>
    </div>
   

    <!-- Add Product Form -->
    <div class="container w-100">
    <div class="product-form">
        <fieldset>
        <legend>
        <form method="POST" action="Roses-admin.php" class="d-flex flex-row flex-wrap mt-20" enctype="multipart/form-data">
        <!--<div>
        <label for="name" >Product Name:</label>
        <input type="text"  name="name" id="name" required><br>
        </div>-->
        <div class="w-100 mb-10 ms-20" >
            <label for="name" class="w-10 display-8 fw-bold" >Product Name:</label>
            <input type="text" class="ms-10" name="name" id="name" required><br>
        </div>
        
<div class="w-100 mb-20 ms-20">
<label for="description" class="w-10 display-8 fw-bold"> Product Description:</label>
        <input type="text" class="w-60" name="description" id="description" required><br>
</div>
<div class="w-100 mb-20 ">
<label for="price" class="w-10 display-8 fw-bold"> Product Price(USD):</label>
        <input type="number" class="w-60" name="price" id="price" required><br>
</div>

<div class="w-50 mb-20 ">
<label for="image" class="w-10 display-8 fw-bold">Product Image:</label>
        <input type="file" name="image" id="image" required><br>
</div>
<div class="product-button">
 <button type="submit">
  Add Product
 </button>
</div>


    </form>
        </legend>
        </fieldset>
       
    

    </div>
    
   
   

    <!-- Display Products -->
    <h2>Product List</h2>
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="mx-auto">Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roses as $product): ?>
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
                        </div>
</body>
</html>
