<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Booking Website</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <nav class="navbar">
        <h2>Labour Booking</h2>
        <ul>
            <li><a href="#services">Services</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="feedback.php">feedback</a></li>
        </ul>
    </nav>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="./piks/portrait-person-working-construction-industry.jpg" alt="Slide 1">
        </div>
        <div class="mySlides fade">
            <img src="./piks/construction-4754312_1280.jpg" alt="Slide 2">
        </div>
        <div class="mySlides fade">
            <img src="./piks/workers-examining-work.jpg" alt="Slide 3">
        </div>
    </div>

    <header>
        <h1>Labour Booking Made Easy</h1>
        <p>Your one-stop solution for reliable labor services.</p>
        <a href="login.php" class="cta-button">Get Started</a>
    </header>

    <section class="features" id="services">
        <h2>Why Choose Us?</h2>
        <div class="feature">
            <h3>Skilled Professionals</h3>
            <p>We connect you with experienced and vetted laborers for all your needs.</p>
        </div>
        <div class="feature">
            <h3>Flexible Booking</h3>
            <p>Book labor services at your convenience, anytime, anywhere.</p>
        </div>
        <div class="feature">
            <h3>Affordable Rates</h3>
            <p>Get quality services without breaking the bank.</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Labour Booking Website. All rights reserved.</p>
    </footer>

    <script>
        // JavaScript for slideshow functionality
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            slides[slideIndex - 1].style.display = "block";  
            setTimeout(showSlides, 5000); // Change image every 5 seconds
        }
    </script>
</body>
</html>