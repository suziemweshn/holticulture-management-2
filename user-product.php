<?php
session_start();

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

// Retrieve products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- User Page HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="css/task6.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1>User Page</h1>
    
    <!-- Display Products -->
<section class="product-display ">
    <div class="container d-flex flex-row flex-wrap">
    <?php foreach ($products as $product): ?>
        <div class="product-list ms-5 mb-10 h-70 w-30 mt-20">
        <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" width="100" height="100">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                    <div class="product-details ">
                    <?php echo $product['name']?><br>
                        <?php echo $product['description']?><br>
                        <?php echo $product['price']?>

                    </div>
                    </div>
                    <?php endforeach; ?>
                    </div>
    </section>
    <!--<div class="row d-flex ">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class=" ">
            <?php foreach ($products as $product): ?>
                <div class="card-img-top">

                    <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" width="100">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                    <div class="card-body">
                    
                    <div class="card-text">
                        <?php echo $product['name']?>
                        <?php echo $product['description']?>
                        <?php echo $product['price']?>

                    </div>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
                    </div>

       <!-- <thead>
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
    </table>-->
</body>
</html>
                