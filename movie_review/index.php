
<?php
session_start();
include 'db/connection.php'; // Include database connection

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <ul>
            <li><a href="user/login.php">Home</a></li>
                    <li><a href="user/view_reviews.php">View Reviews</a></li>
                    <li><a href="user/submit_review.php">Submit a Review</a></li>
                    <li><a href="user/spotlight.php">Movie Spotlight</a></li>
                    <li><a href="user/logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="logo">
            <img src="user/images/pacific-rim.jpg" alt="img">
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="background-image"></div>
        <div class="content">
            <h1>MovieFlix</h1>
            <p>Where movies meet opinions</p>
            <button>Discover New Movies</button>
        </div>
    </section>

    <!-- Featured Reviews Section -->
    <section class="featured-reviews">
        <h2>Latest Reviews</h2>
        <div class="review">
            <img src="user/images/photo_2024-10-13_20-55-42.jpg" alt="Movie 1 Poster">
            <div class="review-content">
                <h3>Thangalaan</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="rating">4.5/5 stars</div>
                <button>Read More</button>
            </div>
        </div>
        <div class="review">
            <img src="user/images/photo_2024-10-13_20-55-50.jpg" alt="Movie 2 Poster">
            <div class="review-content">
                <h3>Thalavan</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="rating">4.2/5 stars</div>
                <button>Read More</button>
            </div>
        </div>
        <div class="review">
            <img src="user/images/photo_2024-10-13_20-56-12.jpg" alt="movie poster 3">
            <div class="review-content">
                <h3>Laapataa Ladies</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="rating">4.8/5 stars</div>
                <button>Read More</button>
            </div>
        </div>
    </section>

    <!-- Top Rated Movies Section -->
    <section class="top-rated">
        <h2>Top Rated Movies</h2>
        <ul>
            <li>
                <img src="user/images/photo_2024-10-13_22-26-40.jpg" alt="Movie 1 Poster">
                <div class="movie-info">
                    <h3>Manjummel Boys</h3>
                    <div class="rating">4.5/5 stars</div>
                    <p>(123 reviews)</p>
                </div>
            </li>
            <li>
                <img src="user/images/photo_2024-10-13_22-26-45.jpg" alt="Movie 2 Poster">
                <div class="movie-info">
                    <h3>Aavesham</h3>
                    <div class="rating">4.2/5 stars</div>
                    <p>(90 reviews)</p>
                </div>
            </li>
            <li>
                <img src="user/images/photo_2024-10-13_22-27-26.jpg" alt="Movie 3 Poster">
                <div class="movie-info">
                    <h3>Thallumaala</h3>
                    <div class="rating">4.8/5 stars</div>
                    <p>(150 reviews)</p>
                </div>
            </li>
        </ul>
        <button>View More</button>
    </section>

    <!-- Latest Releases Section -->
    <section class="latest-releases">
        <h2>Latest Releases</h2>
        <ul>
            <li>
                <img src="user/images/WhatsApp Image 2024-10-13 at 22.43.01_6dbedf4b.jpg" alt="Movie 1 Poster">
                <div class="movie-info">
                    <h3>Kishkindha Kandam</h3>
                    <p>Released: 2024-09-12</p>
                    <p>thriller movie</p>
                </div>
            </li>
            <li>
                <img src="user/images/photo_2024-10-13_22-37-50.jpg" alt="Movie 2 Poster">
               
                <div class="movie-info">
                    <h3>Kondal</h3>
                    <p>Released: 2024-10-13</p>
                    <p>action movie</p>