<?php
include 'includes/config.php';
include 'includes/header.php';

if (!isset($_SESSION['username'])) {
    echo "<p>Please <a href='login.php'>login</a> to proceed to checkout.</p>";
    include 'includes/footer.php';
    exit();
}

$user_id = $_SESSION['user_id'];

echo "<h2>Checkout</h2>";

// Fetch items from cart to display for final confirmation
$sql = "SELECT p.name, p.price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id='$user_id'";
$result = $conn->query($sql);

$total = 0;
echo "<div class='order-summary'>";
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    echo "<p>{$row['name']} - {$row['quantity']} x \${$row['price']} = \$$subtotal</p>";
}
echo "<h3>Total: \$$total</h3>";

// Place order and clear cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn->query("INSERT INTO orders (user_id, total, status) VALUES ('$user_id', '$total', 'Pending')");
    $order_id = $conn->insert_id;

    $sql = "SELECT * FROM cart WHERE user_id='$user_id'";
    $cart_items = $conn->query($sql);
    
    while ($item = $cart_items->fetch_assoc()) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $conn->query("SELECT price FROM products WHERE id='$product_id'")->fetch_assoc()['price'];
        
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
    }

    // Clear cart after order is placed
    $conn->query("DELETE FROM cart WHERE user_id='$user_id'");
    echo "<p>Order placed successfully!</p>";
    header("Location: profile.php");
}
?>

<form method="post">
    <button type="submit">Confirm Order</button>
</form>

<?php include 'includes/footer.php'; ?>
