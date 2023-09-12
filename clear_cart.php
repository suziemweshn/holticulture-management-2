<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear the cart by unsetting the $_SESSION['cart'] array
    unset($_SESSION['cart']);
    echo "Cart cleared.";
} else {
    echo "Invalid request method.";
}
?>
