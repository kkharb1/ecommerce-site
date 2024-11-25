<?php
// Start the session if it hasn’t been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Site</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo">
            <a href="/index.php">eCommerce Site</a>
        </div>
        <nav>
            <a href="/index.php">Home</a>
            <a href="/shop.php">Shop</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="/profile.php">Profile</a>
                <a href="/cart.php">Cart</a>
                <a href="/checkout.php">Checkout</a>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <a href="/admin/admin_products.php">Admin Products</a>
                    <a href="/admin/admin_orders.php">Admin Orders</a>
                <?php endif; ?>
                <a href="/logout.php">Logout</a>
            <?php else: ?>
                <a href="/login.php">Login</a>
                <a href="/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
