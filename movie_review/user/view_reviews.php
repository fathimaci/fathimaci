<?php
session_start();
include '../db/connection.php'; // Include database connection

// Fetch all reviews from the database
$query = "SELECT r.review_text, r.rating, u.username, m.title, m.image_url 
          FROM reviews r
          JOIN users u ON r.user_id = u.id
          JOIN movies m ON r.movie_id = m.id
          ORDER BY r.id DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reviews</title>
    <link rel="stylesheet" href="review.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="submit_review.php">Submit a Review</a></li>
                <li><a href="view_reviews.php">View Reviews</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Reviews Section -->
    <section class="reviews">
        <h1>All Movie Reviews</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="review-card">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?> Poster" class="movie-poster">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><?php echo htmlspecialchars($row['review_text']); ?></p>
                    <div class="rating">Rating: <?php echo htmlspecialchars($row['rating']); ?>/5</div>
                    <div class="reviewer">Reviewed by: <?php echo htmlspecialchars($row['username']); ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No reviews found.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 MovieFlix. All Rights Reserved.</p>
    </footer>
</body>
</html>
