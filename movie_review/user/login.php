<?php
session_start();
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../index.php"); // Redirect to view reviews
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Movie Review Website - Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="vie_reviews.php">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <form action="login.php" method="post">
                <h2>Login to Your Account</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <p><a href="#">Forgot password?</a></p>
                <input type="submit" value="Login">
                <p id="error"></p>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Movie Review Website</p>
    </footer>
</body>
</html>
