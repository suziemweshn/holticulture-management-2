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

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // User is not logged in, store the product in a temporary session variable
    if (!isset($_SESSION['temp_cart'])) {
        $_SESSION['temp_cart'] = [];
    }
    
    $_SESSION['temp_cart'][] = $product;
    echo ("user is not logged in");
    // Redirect to login page
    //header('Location: customer-login.html');
    exit ();
}


// User is logged in, proceed to add product to the cart
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
echo ("user is logged in ");
// Redirect back to the user page or display success message
//eader('Location: customer-profile.php');
exit();
?>
