<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding:0;
            margin:0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            /* color: #4CAF50; */
            color:black;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            /* background-color: #4CAF50; */
            background-color:yellow;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            /* background-color: #45a049; */
            background-color:orangered;
        }

        .success,
        .error {
            text-align: center;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }

        .success {
            background-color: #4CAF50;
        }

        .error {
            background-color: #f44336;
        }

        nav {
            /* background-color: white; */
            background-color:rgb(32, 32, 44);
            width: 100%;
            height: 15px;
            padding: 15px 0;
            /* padding:12px 0; */
            /* margin-right:50px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sappy {
            width: 80%;
            height: 80px;
            display: flex;
            justify-content: space-between;
        }

        .hi {
            width: 30%;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hello {
            font-size: 17px;
            text-decoration: none;
            color: white;
        }
        h1{
            color:yellow;
        }
    </style>
</head>

<body>
    <nav>
        <div class="sappy">
            <h1>labour booking</h1>
            <div class="hi">
                <a href="home.php" class="hello">Home</a>
                <a href="login.php" class="hello">Login</a>
                <a href="register.php" class="hello">Register</a>
                <a href="feedback.php" class="hello">Feedback</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Submit Feedback</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = mysqli_connect("localhost", "root", "", "labour_booking");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];


            $sql = "INSERT INTO feedback (name, email, message, feedback_date) VALUES ('$name', '$email', '$message', NOW())";

            if (mysqli_query($conn, $sql)) {
                echo '<div class="success">Thank you for your feedback!</div>';
            } else {
                echo '<div class="error">Error: ' . mysqli_error($conn) . '</div>';
            }

            mysqli_close($conn);
        }
        ?>

        <form action="feedback.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <input type="submit" value="Submit Feedback">
        </form>
    </div>

</body>

</html>