<?php
include 'includes/config.php';
include 'includes/header.php';
?>

<section class="shop-products">
    <h2>Shop Our Products</h2>
    <div class="product-list">
        <?php
        // Fetch all products from the database
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        // Loop through each product and display it as a card
        while ($product = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <h3>" . htmlspecialchars($product['name']) . "</h3>
                    <p class='price'>Price: $" . number_format($product['price'], 2) . "</p>
                    <p>" . htmlspecialchars($product['description']) . "</p>
                    <a href='product_details.php?id=" . urlencode($product['id']) . "'>View Details</a>
                    <form action='cart.php' method='post'>
                        <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                        <button type='submit'>Add to Cart</button>
                    </form>
                  </div>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
