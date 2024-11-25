<?php
include 'includes/config.php';
include 'includes/header.php';

// Check if the user is logged in by verifying if 'user_id' is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>login</a> to access your cart.</p>";
    include 'includes/footer.php';
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Add item to cart if POST request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Check if the product is already in the cart
    $sql = "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If the product is already in the cart, increase the quantity
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id='$user_id' AND product_id='$product_id'");
    } else {
        // If the product is not in the cart, add it with quantity 1
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)");
    }

    echo "<p>Product added to cart. <a href='shop.php'>Continue Shopping</a> or <a href='cart.php'>View Cart</a>.</p>";
}

// Display cart items (Optional: you can expand this section to display cart contents)
$sql = "SELECT p.name, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id='$user_id'";
$result = $conn->query($sql);

echo "<h2>Your Cart</h2>";
echo "<ul>";
while ($item = $result->fetch_assoc()) {
    echo "<li>{$item['name']} - Quantity: {$item['quantity']}</li>";
}
echo "</ul>";

include 'includes/footer.php';
?>
