<?php
session_start();

// Log out
session_destroy();

// Redirect to login page or another appropriate page
header("Location: customer-login.html");
exit();
?>
