<?php
session_start();
include '../db/connection.php'; // Include database connection

// Ensure the user is admin
if ($_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <a href="manage_reviews.php">Manage Reviews</a> | 
    <a href="manage_users.php">Manage Users</a>
</body>
</html>
