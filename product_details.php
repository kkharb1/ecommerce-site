<?php
include 'includes/config.php';
include 'includes/header.php';

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id='$product_id'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

echo "<h2>" . $product['name'] . "</h2>";
echo "<p>Price: $" . $product['price'] . "</p>";
echo "<p>" . $product['description'] . "</p>";

if (isset($_SESSION['username'])) {
    echo "<form action='cart.php' method='post'>
            <input type='hidden' name='product_id' value='" . $product_id . "'>
            <button type='submit'>Add to Cart</button>
          </form>";
} else {
    echo "<p><a href='login.php'>Login</a> to add this item to your cart.</p>";
}

include 'includes/footer.php';
?>
