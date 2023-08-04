<!-- add_to_cart.php -->

<?php
session_start();

$productId = $_GET['id'] ?? null;

// Check if the product ID is valid
if ($productId === null) {
    die("Invalid product ID.");
}

$servername="localhost:3307";
$username="root";
$password='1234';
$database="products";

$conn=new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("connection failed: " .$conn->connect_error);
}

// Retrieve the selected product from the database
$query = "SELECT * FROM roses WHERE id = $productId";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
    die("Product not found.");
}

// Add the product to the cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the product is already in the cart, and if so, increase the quantity
$productIndex = -1;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['id'] === $product['id']) {
        $productIndex = $index;
        break;
    }
}

if ($productIndex !== -1) {
    $_SESSION['cart'][$productIndex]['quantity']++;
} else {
    $product['quantity'] = 1;
    $_SESSION['cart'][] = $product;
}

// Redirect back to the user page or display success message
header('Location: cart2.php');
exit();
?>