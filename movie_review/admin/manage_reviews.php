<?php
session_start();
include '../db/connection.php'; // Database connection

// Ensure only admins can access
if ($_SESSION['role'] != 'admin') {
    echo "Access Denied";
    exit;
}

// Fetch all reviews from database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    <title>Manage Reviews</title>
</head>
<body>
    <h1>Manage Reviews</h1>
    <?php while ($review = $result->fetch_assoc()) { ?>
        <p>
            <strong>Movie:</strong> <?= $review['movie_name']; ?><br>
            <strong>Review:</strong> <?= $review['review_text']; ?><br>
            <strong>Status:</strong> <?= $review['status']; ?><br>
            <a href="edit_review.php?id=<?= $review['id']; ?>">Edit</a> | 
            <a href="approve_review.php?id=<?= $review['id']; ?>">Approve</a> | 
            <a href="delete_review.php?id=<?= $review['id']; ?>">Delete</a>
        </p>
    <?php } ?>
</body>
</html>
