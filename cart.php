





<!DOCTYPE html>
<html>
<head>
    <title>Example E-commerce Website</title>
</head>
<body>
   <?php echo $name?>
    <?php echo $price?>
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" value="1">
    <button onclick="addToCart()">Add to Cart</button>

    <div id="cartIcon" onclick="openCart()">
        <img src="cart.png" alt="Cart Icon">
        <span id="cartCount">0</span>
    </div>

    <div id="cartModal" style="display: none;">
        <h2>Shopping Cart</h2>
        <ul id="cartItems">
            <!-- Cart items will be dynamically added here -->
        </ul>
        <button onclick="clearCart()">Clear Cart</button>
        <button onclick="closeCart()">Close</button>
    </div>

    <script>
        let cartCount = 0;
        let cartItems = [];

        function addToCart() {
            const quantityInput = document.getElementById("quantity").value;
            const quantity = parseInt(quantityInput);

            if (quantity > 0) {
                const existingItemIndex = cartItems.findIndex(item => item.productName === "Product Name");
                if (existingItemIndex !== -1) {
                    cartItems[existingItemIndex].quantity += quantity;
                } else {
                    cartItems.push({ productName: "Product Name", price: 19.99, quantity });
                }

                cartCount += quantity;
                updateCartCount();
                updateCartItems();
                alert(quantity + " item(s) added to cart!");
            } else {
                alert("Please enter a valid quantity.");
            }
        }

        function updateCartCount() {
            const cartCountSpan = document.getElementById("cartCount");
            cartCountSpan.innerText = cartCount;
        }

        function updateCartItems() {
            const cartItemsContainer = document.getElementById("cartItems");
            cartItemsContainer.innerHTML = "";

            cartItems.forEach(item => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `
                    <span>${item.productName} - $${item.price} x ${item.quantity} = $${(item.price * item.quantity).toFixed(2)}</span>
                    <button onclick="removeFromCart('${item.productName}')">Remove</button>
                `;
                cartItemsContainer.appendChild(listItem);
            });
        }

        function removeFromCart(productName) {
            const itemIndex = cartItems.findIndex(item => item.productName === productName);

            if (itemIndex !== -1) {
                const removedQuantity = 1;
                if (cartItems[itemIndex].quantity <= 1) {
                    cartItems.splice(itemIndex, 1);
                } else {
                    cartItems[itemIndex].quantity -= 1;
                }

                cartCount -= removedQuantity;
                updateCartCount();
                updateCartItems();
                alert(removedQuantity + " item(s) removed from cart.");
            }
        }

        function openCart() {
            const cartModal = document.getElementById("cartModal");
            cartModal.style.display = "block";
        }

        function closeCart() {
            const cartModal = document.getElementById("cartModal");
            cartModal.style.display = "none";
        }

        function clearCart() {
            cartItems = [];
            cartCount = 0;
            updateCartCount();
            updateCartItems();
            closeCart();
            alert("Cart cleared.");
        }
    </script>
</body>
</html>
