<!-- clear_cart.php -->

<?php
session_start();

// Clear the cart by unsetting the $_SESSION['cart'] array
unset($_SESSION['cart']);

// Redirect back to the cart page
header('Location: cart2.php');
exit();
?>
