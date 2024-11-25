<?php
include '../includes/config.php';
include '../includes/header.php';

// Check if the user is an admin
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // Redirect to the login page if not logged in as an admin
    header("Location: /login.php");
    exit();
}

echo "<h2>Admin - Manage Orders</h2>";

// Query to get all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>";
    while ($order = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$order['id']}</td>
                <td>{$order['user_id']}</td>
                <td>\${$order['total']}</td>
                <td>{$order['status']}</td>
                <td><a href='update_order.php?id={$order['id']}'>Update Status</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

include '../includes/footer.php';
?>
