<?php
session_start();

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

// Retrieve products from the database
$query = "SELECT * FROM roses";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
$roses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roses[] = $row;
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
    <h1 class="text-center">Roses</h1>
    
    <!-- Display Products -->
<section class="product-display ">
    <div class="container-fluid">
    <?php foreach ($roses as $product): ?>
        <div class="product-list d-flex flex-column">
        <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" class="  img-fluid rounded-circle">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                    <div class="product-details mt-5">
                    <?php echo $product['name']?><br>
                    <hr>
                     <?php echo $product['description']?>
                        <hr>
                        <?php echo $product['price']?>   USD
                        <hr>
                        <button type="submit">Add to cart</button>

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
                