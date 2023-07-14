<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .dashboard {
            background-color: #e9ecef;
            padding: 20px;
        }
        .cart {
            background-color: #f8f9fa;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Category 1</a></li>
                    <li><a href="#">Category 2</a></li>
                    <li><a href="#">Category 3</a></li>
                    <!-- Add more categories as needed -->
                </ul>
            </div>
            <div class="col-md-6 dashboard">
                <h4>Trending Items</h4>
                <div class="row">
                    <!-- Display trending items dynamically using PHP -->
                    <?php
                    // Assuming you have an array of trending items
                    $trendingItems = array("Item 1", "Item 2", "Item 3", "Item 4");

                    foreach ($trendingItems as $item) {
                        echo '<div class="col-md-6">' . $item . '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-3 cart">
                <h4>Cart</h4>
                <ul>
                    <!-- Display cart items dynamically using JavaScript -->
                    <li id="cart-item-1">Item 1</li>
                    <li id="cart-item-2">Item 2</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for dynamically adding items to the cart
        // Assuming you have an array of cart items
        var cartItems = ["Item 1", "Item 2"];

        // Function to add an item to the cart
        function addToCart(item) {
            var cart = document.querySelector(".cart ul");
            var li = document.createElement("li");
            li.textContent = item;
            cart.appendChild(li);
        }

        // Add items to the cart
        cartItems.forEach(function (item) {
            addToCart(item);
        });
    </script>
</body>
</html>
