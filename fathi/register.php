<?php
$con = mysqli_connect("localhost", "root", "", "labour_booking");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$errors = [];
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $phone_no = trim($_POST['phone_no']);
    $email_id = trim($_POST['email_id']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($phone_no) || !preg_match('/^[6789]\d{9}$/', $phone_no)) {
        $errors[] = "A valid phone number is required (10 digits, starting with 7, 8, or 9).";
    }
    if (empty($email_id) || !filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Check if there are no errors
    if (count($errors) === 0) {
        $sql = "INSERT INTO users (Name, phone_no, email_id, username, password) VALUES ('$name', '$phone_no', '$email_id', '$username', '$password')";
        $data = mysqli_query($con, $sql);

        if ($data) {
            $sql1 = "INSERT INTO login (emailid, password, usertype) VALUES ('$email_id', '$password', 0)";
            $data1 = mysqli_query($con, $sql1);

            if ($data1) {
                echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error in login table insertion.');</script>";
            }
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Labour Booking</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <h1>Labour Booking</h1>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="feedback.php">Feedback</a></li>
    </ul>
</nav>

<!-- Registration Form -->
<div class="register-container">
    <h2>Register</h2>
    <form action="" method="POST">
    <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <input type="text" name="name" placeholder="Name" required>
        <input type="tel" name="phone_no" placeholder="Phone No" required>
        <input type="email" name="email_id" placeholder="Email ID" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Register" name="submit">
    </form>
</div>
<footer>
        <p>&copy; 2023 Labour Booking Website. All rights reserved.</p>
    </footer>
</body>
</html>
