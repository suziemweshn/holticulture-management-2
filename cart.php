<?php
// Start the session to manage user-specific cart data
session_start();

// Check if the required data is present in the URL parameters
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])) {
  $productId = $_GET['id'];
  $productName = $_GET['name'];
  $price = (float)$_GET['price'];

  // Create or update the cart data in the session
  if (isset($_SESSION['cart'][$productId])) {
    // If the product already exists in the cart, update the quantity
    $_SESSION['cart'][$productId]['quantity']++;
  } else {
    // If the product does not exist in the cart, add it
    $_SESSION['cart'][$productId] = [
      'name' => $productName,
      'price' => $price,
      'quantity' => 1
    ];
  }

  // Redirect back to the product page or cart page after adding the item
  header('Location: product.php');
  exit();
}
?>
