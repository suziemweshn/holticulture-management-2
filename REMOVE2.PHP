<?php
session_start();

include 'conn.php';
include 'oauth.php';
$product_id = $_GET['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        die("Invalid product ID.");
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productId = $_POST['id'];
}
    // Remove the item from the session cart array
   /* $index = array_search($productId, array_column($_SESSION['cart'], 'product_id'));
    if ($index !== false) {
        unset($_SESSION['cart'][$index]);
        echo "Product removed from cart.";
    } else {
        echo "Product not found in cart.";
    }
} else {
    echo "Invalid request method.";
}*/
// Remove the item from the session cart array
$index = array_search($productId, array_column($_SESSION['cart'], 'product_id'));
if ($index !== false) {
    unset($_SESSION['cart'][$index]);
    echo "Product removed from cart.";
} else {
    echo "Product not found in cart.";
}

?>
