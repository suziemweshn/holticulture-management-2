<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php'); 
    exit();
}

include 'conn.php';

$productId = $_GET['id'] ?? null;

// Retrieve the selected product from the database
//$query = "SELECT * FROM roses WHERE id = $productId";
//$result = mysqli_query($conn, $query);


$sql = "SELECT * FROM roses WHERE id = $productId
        UNION
        SELECT * FROM mixed_roses WHERE id = $productId
        UNION
        SELECT * FROM carnations WHERE id= $productId
        UNION
        SELECT * FROM lily WHERE id= $productId
        UNION
        SELECT * FROM seasonal WHERE id= $productId";
        
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
// Check if the product exists
if (!$product) {
    die("Product not found.");
}

// Define the product details
$product_id = $product['id'];
$price = $product['price'];


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
//checking if the product is in the cart
$existingCartItem = array_search($product_id, array_column($_SESSION['cart'], 'product_id'));

if ($existingCartItem !== false) {
    
    $_SESSION['cart'][$existingCartItem]['quantity'] += 1;
} else {
    //adding the cart as new item
    $cartItem = [
        'product_id' => $product_id, 
        'quantity' => 1, 
        'price' => $price,
    ];
    $_SESSION['cart'][] = $cartItem;
    
}

// Add the product to the user's cart in the database
//$username = $_SESSION['username'];
//$sql = "INSERT INTO cart (username, product_id, quantity, price) VALUES ('$username', $product_id, 1, $price)";
$username = $_SESSION['username'];
$sql = "INSERT INTO cart (username, product_id, quantity, price) VALUES (?, ?, 1, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sid", $username, $product_id, $price);
    
    if (mysqli_stmt_execute($stmt)) {
      
        header('Location: cart.php');
       
        exit();
    } else {
      
        echo "Error: " . mysqli_error($conn);
    }
}
    // Close the prepared statement
   // mysqli_stmt_close($stmt);
//} else {
    // Prepare statement failed, display an error message.
   // echo "Error: " . mysqli_error($conn);
//}

//if (mysqli_query($conn, $query)) {
    // Insertion successful, redirect to the cart page or display a success message.
    //header('Location: cart.php');
    //exit();
//} else {
    // Query failed, display an error message and check for any SQL errors.
    //echo "Error: " . $query . "<br>" . mysqli_error($conn);
//}

// Close the database connection
mysqli_close($conn);
?>
