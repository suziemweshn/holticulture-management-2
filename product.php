<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h2>Product 1</h2>
<p>Price: $10</p>
<button onclick="addToCart(1, 'Product 1', 10)">Add to Cart</button>

<h2>Product 2</h2>
<p>Price: $20</p>
<button onclick="addToCart(2, 'Product 2', 20)">Add to Cart</button>

<script>
  function addToCart(productId, productName, price) {
    // Send the product data to the server (you can use AJAX or a form submission).
    // For simplicity, we'll just use a URL parameter to represent the added product.
    window.location.href = `add_to_cart.php?id=${productId}&name=${encodeURIComponent(productName)}&price=${price}`;
  }
</script>
</body>
</html>


