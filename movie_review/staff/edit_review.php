<?php
session_start();
include '../db/connection.php';

// Ensure staff is logged in
if ($_SESSION['role'] != 'staff') {
    header("Location: ../user/login.php");
    exit;
}

// Fetch pending reviews
$sql = "SELECT * FROM reviews WHERE status='pending'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Edit Reviews</title>
</head>
<body>
    <h1>Pending Reviews</h1>

    <table border="1">
        <tr>
            <th>Movie Name</th>
            <th>Review</th>
            <th>Action</th>
        </tr>
        <?php while ($review = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $review['movie_name']; ?></td>
            <td><?= substr($review['review_text'], 0, 100); ?>...</td>
            <td>
                <a href="approve_review.php?id=<?= $review['id']; ?>">Approve</a> |
                <a href="reject_review.php?id=<?= $review['id']; ?>">Reject</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
