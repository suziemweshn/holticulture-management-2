<?php
session_start();

// Clear the cart by unsetting the 'cart' session variable
unset($_SESSION['cart']);

// You can also add a message to notify the user that their order has been canceled
$message = "Your order has been canceled.";
$_SESSION['order_cancel_message'] = $message;

// Redirect the user back to the order form or any other page you prefer
header('Location: order_form.php');
exit();
?>
