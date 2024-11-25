<?php include 'includes/header.php'; ?>

<section class="hero">
    <h1>Welcome to Our eCommerce Site</h1>
    <p>Discover our wide range of products and enjoy seamless shopping.</p>
</section>

<section class="featured-products">
    <h2>Featured Products</h2>
    <div class="product-list">
        <?php
        include 'includes/config.php';
        $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
        $result = $conn->query($sql);

        while ($product = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <h3>" . $product['name'] . "</h3>
                    <p>Price: $" . $product['price'] . "</p>
                    <p>" . $product['description'] . "</p>
                    <a href='product_details.php?id=" . $product['id'] . "'>View Details</a>
                  </div>";
        }
        ?>
    </div>
</section>

<section class="categories">
    <h2>Shop by Category</h2>
    <div class="category-list">
        <div class="category"><h3>Electronics</h3></div>
        <div class="category"><h3>Clothing</h3></div>
        <div class="category"><h3>Home & Kitchen</h3></div>
        <div class="category"><h3>Sports</h3></div>
    </div>
</section>

<section class="testimonials">
    <h2>What Our Customers Say</h2>
    <p>"I love shopping here! The product selection is amazing and the checkout process is seamless."</p>
    <p>"Customer service is top-notch. They really go out of their way to help you find what you need."</p>
</section>

<?php include 'includes/footer.php'; ?>
