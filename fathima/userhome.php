<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE usid = $user_id"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo "User not found.";
        exit();
    }
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userhome.css">
    <title>User Home</title>
</head>
<body>
<nav>
    <div class="sappy">
        <h1>Labour Booking</h1>
        <div class="hi">
            <a href="view_service_providers.php" class="hello">View Service Providers</a>
            <a href="view_bookings.php" class="hello">View Booking Appointments</a>
            <a href="appointment_status.php" class="hello">Appointment Status</a>
            <a href="userprofile.php" class="hello">Edit Profile</a>
            <a href="logout.php" class="hello">Logout</a>
        </div>
    </div>
</nav>


    <header class="header">
        <h2>Welcome to Your Dashboard</h2>
        <p>Your one-stop solution for booking skilled labor.</p>
    </header>

    <main class="main-content">

        <section class="user-info">
            <h3>Your Information</h3>
            <p>Name: <?php echo htmlspecialchars($user['Name']); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email_id']); ?></p>
            <p>Contact: <?php echo htmlspecialchars($user['phone_no']); ?></p>
            <a href="userprofile.php" class="edit-profile">Edit Profile</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Labour Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>
