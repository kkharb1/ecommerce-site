<?php
include 'includes/config.php';
include 'includes/header.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<h2>Our Products</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li><a href='product_details.php?id=" . $row['id'] . "'>" . $row['name'] . " - $" . $row['price'] . "</a></li>";
}
echo "</ul>";

include 'includes/footer.php';
?>
