<?php
session_start();

include 'conn.php';

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

<!DOCTYPE html>
<html>
<head>
<title>User Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="css/task6.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <style>
    .product-list {
        position: relative;
    }

    .cart-button {
        opacity: 0;
        transition: opacity 0.3s ease;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .product-list:hover .cart-button {
        opacity: 1;
    }
</style>

</head>
<body>
    <!-- ... (your header HTML) ... -->

    <h1 class="text-center">Roses</h1>

    <section class="product-display">
        <div class="container-fluid">
            <?php foreach ($roses as $product): ?>
                <div class="product-list">
                    <?php if (!empty($product['image'])): ?>
                        <div class="product-image">
                            <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" class="img-fluid rounded-circle" width="100px" height="100px">
                        </div>
                        <div class="product-details mt-5">
                            <?php echo $product['name'] ?><br>
                            <hr>
                            <?php echo $product['description'] ?>
                            <hr>
                            <?php echo $product['price'] ?> USD
                            <hr>
                            <!-- Add to Cart button -->
                            <?php if (isset($_SESSION['username'])): ?>
                                <a href="Add_to_cart2.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
                            <?php else: ?>
                                <a href="cart2.php?action=add&id=<?php echo $product['id']; ?>">Add to Cart</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ... (your footer scripts) ... -->
</body>
</html>
