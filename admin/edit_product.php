<?php
include '../includes/config.php';
include '../includes/header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: /login.php");
    exit();
}

// Fetch product details
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Update product details
    $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id='$product_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Product updated successfully!</p>";
        header("Location: admin_products.php");
        exit();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<h2>Edit Product</h2>
<form method="post" action="edit_product.php">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <label for="name">Product Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>
    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>
    <label for="description">Description:</label>
    <textarea name="description" required><?php echo $product['description']; ?></textarea><br><br>
    <button type="submit">Update Product</button>
</form>

<?php include '../includes/footer.php'; ?>
