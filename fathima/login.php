<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<nav>
    <div class="sappy">
      <h1>labour booking</h1>
      <div class="hi">
      <a href="login.php" class="hello">login</a>
      <a href="register.php" class="hello">register</a>
      <a href="" class="hello">feedback</a>
      </div>
    </div>
  </nav>
    <div class="content">
    <form action="" class="frm" method="post">
        <div class="imgcontainer">
            <img src="./assets/887604_user_512x512.png" alt="Avatar" class="avatar">
          </div>
        <h1 class="jo">LOGIN</h1>
        <!-- <label for="">username:</label> -->
        <input class="imp1" type="text" name="username" placeholder="email">
        <!-- <label for="">password:</label> -->
        <input class="imp1" type="text" name="password" placeholder="password">
        <!-- <label for="">e-mail:</label> -->
        <!-- <input class="imp1" type="text" name="e-mail"> -->
        <input class="imp2" type="submit" value="login" name="submit">
       <!-- <label> -->
            <!-- <input type="checkbox" checked="checked" name="remember">Remember me -->
        <!-- </label> -->
        <!-- <div> -->
            <!-- <button type="button">cancel</button> -->
            <!-- <a href="#">forgot password</a> -->
        <!-- </div> -->
    </form>
    </div>
</body>
</html>

<?php
$con = mysqli_connect("localhost", "root", "", "labour_booking");
if (!$con) {
    echo "DB not connected";
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Fetch the user details from the login table
    $sql = "SELECT * FROM `login` WHERE emailid='$username' AND password='$password'";
    $data = mysqli_query($con, $sql);

    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $user = mysqli_fetch_assoc($data);
            $usertype = $user['usertype']; // Assuming 'usertype' is the column name

            // Redirect based on user type using if statements
            if ($usertype == 0) {
                header('Location: userhome.html'); // User Dashboard
            } elseif ($usertype == 1) {
                header('Location: staffdash.php'); // Staff Dashboard
            } elseif ($usertype == 2) {
                header('Location: adminhome.html'); // Admin Dashboard
            } else {
                echo "<script>alert('Invalid user type')</script>";
            }
            exit(); 
        } else {
            echo "<script>alert('User not found')</script>";
        }
    } else {
        echo "<script>alert('Query error')</script>";
    }
} else {
    echo "Invalid form";
}
?>

