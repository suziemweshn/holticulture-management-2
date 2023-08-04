<!-- remove_from_cart.php -->

<?php
session_start();

if (!isset($_GET['id'])) {
    die("Invalid product ID.");
}

$productId = $_GET['id'];

// Find the item in the cart based on the product ID
$index = array_search($productId, array_column($_SESSION['cart'], 'id'));

// If the item is found, remove it from the cart
if ($index !== false) {
    unset($_SESSION['cart'][$index]);
}

// Redirect back to the cart page
header('Location: cart2.php');
exit();
?>
