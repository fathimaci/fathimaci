<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labour Booking Portal</title>
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            /* Add a background image to the body or the slideshow */
            background: url('path/to/your/background-image.jpg') no-repeat center center fixed; /* Adjust the path as needed */
            background-size: cover; /* Cover the entire background */
        }

        .slideshow-container {
            position: relative;
            max-width: 100%;
        }

        .slideshow-text {
            position: absolute;
            top: 35%; /* Adjusted for more space */
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white; /* Change text color as needed */
            height: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            padding: 20px; /* Add some padding */
            border-radius: 8px; /* Rounded corners */
        }

        .slideshow-text p {
            margin: 0; /* Remove default margin from paragraph */
            font-size: 20px; /* Increase font size for better visibility */
            font-weight: bold; /* Make the text bold */
            text-shadow: 1px 1px 2px black; /* Add a shadow for better contrast */
        }

        .get-started {
            display: inline-block; /* Make it inline-block */
            margin-top: 10px; /* Add margin above button */
            padding: 10px 20px;
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .get-started:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
  <nav>
    <div class="sappy">
      <h1>Labour Booking</h1>
      <div class="hi">
        <a href="login.php" class="hello">Login</a>
        <a href="register.php" class="hello">Register</a>
        <a href="feedback.php" class="hello">Feedback</a>
      </div>
    </div>
  </nav>
  
  <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="../fathima/piks/male-electrician-works-switchboard-with-electrical-connecting-cable.jpg" alt="Slide 1">
        </div>
        <div class="mySlides fade">
            <img src="../fathima/piks/portrait-person-working-construction-industry.jpg" alt="Slide 2">
        </div>
        <div class="mySlides fade">
            <img src="../fathima/piks/workers-examining-work.jpg" alt="Slide 3">
        </div>

        <div class="slideshow-text">
            <p>Welcome to the Labour Booking Portal! Your one-stop solution for hiring skilled labor.</p>
            <a href="login.php" class="get-started">Get Started</a>
        </div>

        <br>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span> 
            <span class="dot" onclick="currentSlide(2)"></span> 
            <span class="dot" onclick="currentSlide(3)"></span> 
        </div>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        function currentSlide(n) {
            slideIndex = n - 1;
            showSlides();
        }
    </script>
</body>
</html>
