<?php
include 'includes/config.php';
include 'includes/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome, " . $_SESSION['username'] . "</h2>";
echo "<p>View your profile information here.</p>";

include 'includes/footer.php';
?>
