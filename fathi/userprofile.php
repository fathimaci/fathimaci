<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id']; 

// Fetch user details
$sql = "SELECT * FROM users WHERE usid = $user_id"; 
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $old_email = $user['email_id'];

    $update_sql = "UPDATE users SET Name='$name', email_id='$email', phone_no='$phone' WHERE usid=$user_id";

    if (mysqli_query($conn, $update_sql)) {
        $update_login_sql = "UPDATE login SET emailid='$email' WHERE emailid='$old_email'";

        if (mysqli_query($conn, $update_login_sql)) {
            echo "<p>Profile updated successfully!</p>";
            header('Location: userprofile.php');
        } else {
            echo "<p>Error updating login table: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>Error updating profile: " . mysqli_error($conn) . "</p>";
    }

    // Fetch updated user details
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userprofile.css">
    <title>Edit Profile</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="userhome.php" class="hello">Home</a>
                <a href="view_bookings.php" class="hello">View Bookings</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <header class="header">
            <h2>Edit Profile</h2>
        </header>

        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email_id']); ?>" required>

            <label for="phone">Contact Number:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone_no']); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Labour Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>
