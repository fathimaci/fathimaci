
<?php
session_start();
include '../db/connection.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch movie list from the database
$query = "SELECT * FROM movies"; // Assuming you have a 'movies' table
$result = $conn->query($query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_id = $_POST['movie_id'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    // Insert review into the database
    $query = "INSERT INTO reviews (user_id, movie_id, review_text, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisi", $user_id, $movie_id, $review_text, $rating);
    
    if ($stmt->execute()) {
        header("Location: view_reviews.php?message=Review+submitted+successfully");
        exit();
    } else {
        $error = "Error submitting the review.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="submit_review.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="view_reviews.php">View Reviews</a></li>
                <li><a href="submit_review.php">Submit a Review</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Submit Review Form -->
    <section class="submit-review">
        <h1>Submit Your Review</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="submit_review.php">
            <label for="movie_id">Select Movie</label>
            <select id="movie_id" name="movie_id" required>
                <option value="">-- Select a Movie --</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="review_text">Review</label>
            <textarea id="review_text" name="review_text" required></textarea>
            
            <label for="rating">Rating</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
            
            <button type="submit">Submit Review</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 MovieFlix. All Rights Reserved.</p>
    </footer>
</body>
</html>
