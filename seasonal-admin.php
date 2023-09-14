<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include  'conn.php';

/* Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $productId = $_POST['delete'];

        // Delete the product from the database
        $deleteQuery = "DELETE FROM roses WHERE id = $productId";
        mysqli_query($conn, $deleteQuery);

        // Delete the product image file (optional)
        // Assuming the images are stored in the directory '/main project/product-images/'
        //$targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/product-images/';
      //  $productImage = $_POST['image']; // Retrieve the image name from the form
      //  $productImagePath = $targetDirectory . $productImage;
       // if (file_exists($productImagePath)) {
          //  unlink($productImagePath);
        
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {

        
       
        echo $product['name'];
        echo $product['description'];
        echo $product['price'];
        echo $product['image'];
        

        // Update the product in the database
        $updateQuery = "UPDATE roses SET name = '$name', description = '$description', price = $price WHERE id = $productId";
        mysqli_query($conn, $updateQuery);
    }
*/
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $productId = $_POST['delete'];

        // Delete the product from the database
        $deleteQuery = "DELETE FROM  seasonal WHERE id = $productId";
        mysqli_query($conn, $deleteQuery);

        // Delete the product image file (optional)
        // Assuming the images are stored in the directory '/main project/product-images/'
       /* $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/product-images/';
        $productImage = $_POST['image']; // Retrieve the image name from the form
        $productImagePath = $targetDirectory . $productImage;
        if (file_exists($productImagePath)) {
            unlink($productImagePath);*/
        }
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {
        $productId = $_POST['edit'];
        
        // Retrieve the updated form data
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Update the product in the database
        $updateQuery = "UPDATE seasonal SET name = '$name', description = '$description', price = $price WHERE id = $productId";
        mysqli_query($conn, $updateQuery);
    }



    // Handle add product form submission
    if (isset($_POST['add'])) {
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
           // if (file_exists($targetFile)) {
            //    die('Error: File already exists.');
           // }

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

            // Move the uploaded imageto the product-images folder
            if (!move_uploaded_file($tempFilePath, $targetFile)) {
                die('Error: Failed to upload the file.');
            }
        } else {
            die('Error: No image file was uploaded.');
        }

        // Insert the product into the products table
        $query = "INSERT INTO seasonal (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
        mysqli_query($conn, $query);
    }


// Retrieve products from the database
$query = "SELECT * FROM seasonal";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
$seasonal = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (!array_key_exists('image', $row) || $row['image'] === null) {
        // The "image" field is not present or null in the result set
        echo "Warning: Image field is missing or null in the database row.";
        var_dump($row); // Debugging statement
        continue;
    }

    // Add the row to the products array
    $seasonal[] = $row;
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
    <style>
        .update-button button{
            background-color:lime;
  color: white;
  font-size: 20px;
  width: 60%;
        }
    </style>
</head>
<body>
<header>
        <!-- Header Start -->
        <div class="header-area mb-20">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <ul>     
                                        <li>Email: Akimafarm@gmail.com</li>
                                    </ul>
                                    <div class="header-social">    
                                        <ul>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a  href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img src="img/org.png" alt="" height="50px"></a> AHF
                                    
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="index.html">Home</a></li>
                                                <li><a href="index.html#about">About</a></li>
                                                <li><a href="">Products</a>
                                                 <ul class="submenu">
                           <li><a href="flowers.html">Flowers</a></li>
                           <li><a href="vegetable.html">Vegetables</a></li>
                           <li><a href="fruits.html">Fruits</a></li>
                           <li><a href="dairy.html">Dairy Products</a></li>
                           
                        </ul>
                                                </li>
                                                <li><a href="#">Portals</a>
                                                  <ul class="submenu">
                            <li><a href="pages-login.html">Admin Portal</a></li>
                            <li><a href="employee-login.html">Employee portal</a></li>
                            
                            
                         </ul>
                                                 </li>
                                                 <li><a href="category.html">My account</a>
                                                  <ul class="submenu">
                            <li><a href="datascience.html">Log in</a></li>
                            <li><a href="ai.html">Sign up</a></li>
                            
                         </ul>
                                                 </li>
                                                 <li><a href="Blog.html">Blog</a></li>
                                                
                                                <li><a href="contact.html">Contacts</a></li>
                                                
                                            </ul>
                                            <div class="search">
                                                <form class="d-flex">
                                                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    
        <ul id="myMenu">
         <!-- <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Products</a></li>
          <li><a href="#">Portals</a></li>
          <li><a href="#">Account</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contacts</a></li>-->
          
        </ul>
                                                    
                                                  </form>
                                            </div>
                                           
                                        </nav>
                                       
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
        <!-- Header End -->
    <div class="heading mt-20 mb-20">
        <h3>seasonal Admin page</h3>
    </div>

    <!-- Add Product Form -->
    <div class="container w-100">
        <div class="product-form">
            <form method="POST" action="seasonal-admin.php" class="d-flex flex-row flex-wrap mt-20" enctype="multipart/form-data">
                <div class="w-100 mb-10 ms-20">
                    <label for="name" class="w-10 display-8 fw-bold">Product Name:</label>
                    <input type="text" class="ms-10" name="name" id="name" required><br>
                </div>
                <div class="w-100 mb-20 ms-20">
                    <label for="description" class="w-10 display-8 fw-bold">Product Description:</label>
                    <input type="text" class="w-60" name="description" id="description" required><br>
                </div>
                <div class="w-100 mb-20">
                    <label for="price" class="w-10 display-8 fw-bold">Product Price(USD):</label>
                    <input type="number" class="w-60" name="price" id="price" required><br>
                </div>
                <div class="w-50 mb-20">
                    <label for="image" class="w-10 display-8 fw-bold">Product Image:</label>
                    <input type="file" name="image" id="image" required><br>
                </div>
                <div class="product-button">
                    <button type="submit" name="add">Add Product</button>
                </div>
            </form>
        </div>

       
        <!-- Display Products -->
<h2 class="text-center">Product List</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="mx-auto">Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($seasonal as $product): ?>
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
                <td>
                    <form method="POST" action="seasonal-admin.php" class="update-button">
                        <input type="hidden" name="delete" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>

                    <form method="POST" action="Mixed-Roses-Admin.php" class="update-button">
                        <input type="hidden" name="edit" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <div class="w-100 mb-10 ms-20">
                            <label for="name" class="w-10 display-8 fw-bold">Product Name:</label>
                            <input type="text" class="ms-10" name="name" id="name" value="<?php echo $product['name']; ?>" required><br>
                        </div>
                        <div class="w-100 mb-20 ms-20">
                            <label for="description" class="w-10 display-8 fw-bold">Product Description:</label>
                            <input type="text" class="w-60" name="description" id="description" value="<?php echo $product['description']; ?>" required><br>
                        </div>
                        <div class="w-100 mb-20">
                            <label for="price" class="w-10 display-8 fw-bold">Product Price(USD):</label>
                            <input type="number" class="w-60" name="price" id="price" value="<?php echo $product['price']; ?>" required><br>
                        </div>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    </div>
</body>
</html>
