<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php'); // Redirect to the login page if not logged in
    exit();
}

include 'conn.php';

$productId = $_GET['id'] ?? null;





// Retrieve the selected product from the database
$query = "SELECT * FROM roses WHERE id = $productId";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
    die("Product not found.");
}

// Define the product details
$product_id = $product['id'];
$price = $product['price'];

// Add the product to the user's cart in the database
$username = $_SESSION['username'];
$query = "INSERT INTO cart (username, product_id, quantity, price) VALUES ('$username', $product_id, 1, $price)";

if (mysqli_query($conn, $query)) {
    // Insertion successful, update the cart session variable.
    $cartItem = [
        'product_id' => $product_id,
        'quantity' => 1, // Initial quantity
        'price' => $price,
      
    ];

    $productId=$_SESSION['product_id'];

    // If 'cart' session variable is not set, initialize it as an empty array.
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Append the new cart item to the session variable.
    $_SESSION['cart'][] = $cartItem;

    // Redirect to the cart page or display a success message.
    header('Location: cart.php');
    exit();
} else {
    // Query failed, display an error message and check for any SQL errors.
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
