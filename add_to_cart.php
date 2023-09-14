<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php'); 
    exit();
}

include 'conn.php';

$productId = $_GET['id'] ?? null;


$sql = "SELECT *, 'carnations' AS table_name FROM carnations WHERE id = $productId
        UNION 
        SELECT *, 'lily' AS table_name FROM lily WHERE id = $productId
        UNION 
        SELECT *, 'roses' AS table_name FROM roses WHERE id = $productId
        UNION 
        SELECT *, 'mixed_roses' AS table_name FROM mixed_roses WHERE id = $productId
        UNION 
        SELECT *, 'seasonal' AS table_name FROM seasonal WHERE id = $productId";

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
    die("Product not found.");
}

// Define the product details
$id = $product['id'];
$name = $product['name'];
$description = $product['description'];
$price = $product['price'];
$image = $product['image']; 
$quantity = 1; 
$username = $_SESSION['username'];

// Check if the item already exists in the cart
$existingCartItem = array_search($product_id, array_column($_SESSION['cart'], 'product_id'));

if ($existingCartItem !== false) {
    // If the item is already in the cart, increment the quantity
   // $_SESSION['cart'][$existingCartItem]['quantity'] += 1;

    // If it's a new item, add it to the cart session
    $cartItem = [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'username' => $username,
        'image' => $image, 
    ];
    $_SESSION['cart'][] = $cartItem;
}

// Add the product to the user's cart in the database
//$sql = "INSERT INTO cart (name, description, price, quantity, username, image) VALUES (?, ?, ?, ?, ?, ?)";
//$stmt = mysqli_prepare($conn, $sql);

//if ($stmt) {
    //mysqli_stmt_bind_param($stmt, "ssdssb", $name, $description, $price, $quantity, $username, $image);
    
   // if (mysqli_stmt_execute($stmt)) {
       // header('Location: cart.php');
       // exit();
   // } else {
       // echo "Error: " . mysqli_error($conn);
   // }
//} else {
    //echo "Error: " . mysqli_error($conn);
//}
$sql = "INSERT INTO cart (name, description, price, quantity, username, image) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssdsss", $name, $description, $price, $quantity, $username, $image);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: cart.php');
        exit();
    } else {
        echo "Error inserting into cart: " . mysqli_error($conn); 
    }
} else {
    echo "Error preparing SQL statement: " . mysqli_error($conn); 
}

mysqli_close($conn);
?>

