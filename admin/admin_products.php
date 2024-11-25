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

// Create (Add new product)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', '$price', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Product added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Delete Product
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM products WHERE id='$delete_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Product deleted successfully!</p>";
    } else {
        echo "<p>Error deleting product: " . $conn->error . "</p>";
    }
}
?>

<h2>Admin - Manage Products</h2>

<!-- Form to Add New Product -->
<h3>Add New Product</h3>
<form method="post" action="admin_products.php">
    <input type="hidden" name="add_product" value="1">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br><br>
    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" required><br><br>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br><br>
    <button type="submit">Add Product</button>
</form>

<?php
// Read (Display existing products)
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Existing Products</h3>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>";
    while ($product = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$product['id']}</td>
                <td>{$product['name']}</td>
                <td>\${$product['price']}</td>
                <td>{$product['description']}</td>
                <td>
                    <a href='edit_product.php?id={$product['id']}'>Edit</a> | 
                    <a href='admin_products.php?delete_id={$product['id']}' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

include '../includes/footer.php';
?>
