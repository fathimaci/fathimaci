<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Labour Booking</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h1>Labour Booking</h1>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="feedback.php">feedback</a></li>
            </ul>
        </div>
    </nav>
    <!-- <div class="bdy">
        <img src="./piks/construction-4754310_1280.jpg" alt="">
    </div> -->

    <div class="container">
        <h2>Login to Your Account</h2>
        <form id="loginForm" method="POST" >
            <div class="form-group">
                <input type="email" placeholder="email" name="username" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="password" name="password" required>
            </div>
            <button name="submit" type="submit">Login</button>
        </form>
        <p>Don't have an account? <a class="reg" href="register.php">Register here</a></p>
    </div>
    <footer>
        <p>&copy; 2023 Labour Booking Website. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "labour_booking");
if (!$con) {
    echo "DB not connected";
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `login` WHERE emailid='$username' AND password='$password'";
    echo "$sql";
    $data = mysqli_query($con, $sql);

    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $user = mysqli_fetch_assoc($data);
            $usertype = $user['usertype'];
            if ($usertype == 0) {
                $sqlUser = "SELECT usid FROM `users` WHERE email_id='$username'";
                $userDetails = mysqli_query($con, $sqlUser);
                if ($userDetails && mysqli_num_rows($userDetails) > 0) {
                    $userInfo = mysqli_fetch_assoc($userDetails);
                    $_SESSION['user_id'] = $userInfo['usid'];
                    header('Location: userhome.php');
                    exit();
                }}
                elseif ($usertype == 1) {
                    $sqlStaff = "SELECT id, status FROM `staff` WHERE emailid='$username'";
                    $staffDetails = mysqli_query($con, $sqlStaff);
                    
                    if ($staffDetails && mysqli_num_rows($staffDetails) > 0) {
                        $staffInfo = mysqli_fetch_assoc($staffDetails);
                        
                        if ($staffInfo['status'] == 'active') {
                            $_SESSION['staff_id'] = $staffInfo['id'];
                            header('Location: staffdash.php');
                            exit();
                        } else {
                            echo "<script>alert('Your account is inactive. Please contact the admin.');
                            window.location.href='login.php';</script>";
                            exit();
                        }
                    } else {
                        echo "<script>alert('Staff not found or invalid credentials.');</script>";
                        header('Location: login.php');
                        exit();
                    }
                }
                
             elseif ($usertype == 2) {
                header('Location: adminhome.php');
                exit();
            } else {
                echo "<script>alert('Invalid user type')</script>";
            }
        } else {
            echo "<script>alert('User not found')</script>";
        }
    }}

?>


