<?php
include 'includes/config.php';
include 'includes/header.php';

// Check if the user is an admin
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // Redirect to the login page if not logged in as an admin
    header("Location: /login.php");
    exit();
}

echo "<h2>Admin Dashboard</h2>";
?>

<div>
    <h3>Manage Site</h3>
    <ul>
        <li><a href="admin/admin_orders.php">Manage Orders</a></li>
        <li><a href="admin/admin_products.php">Manage Products</a></li>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>
