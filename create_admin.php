<?php
include 'includes/config.php';

// Admin credentials
$username = 'admin';
$email = 'admin@gmail.com';
$password = 'pass123'; // Change this to your desired password

// Hash the password using PHP
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the admin user into the database
$sql = "INSERT INTO users (username, email, password, is_admin) VALUES ('$username', '$email', '$hashed_password', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
