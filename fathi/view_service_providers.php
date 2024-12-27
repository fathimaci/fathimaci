<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch available staff, including their categories
$sql = "SELECT * FROM staff"; // Assuming you have a 'staff' table
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_service_provider.css">
    <title>Available Staff</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="userhome.php" class="hello">Home</a>
                <!-- <a href="view_service_providers.php" class="hello">View Service Providers</a>  -->
                <!-- <a href="statistics.php" class="hello">Statistics</a> -->

                <a href="view_bookings.php" class="hello">View Booking Appointments</a>
                <a href="appointment_status.php" class="hello">Appointment Status</a>

                <a href="userprofile.php" class="hello">Edit Profile</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <header class="header">
        <h2>Available Service Providers</h2>
    </header>

    <main class="main-content">
        <section class="staff-list">
            <h3>Our Staff</h3>
            <ul>
                <?php
                while ($staff = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<strong>" . htmlspecialchars($staff['Name']) . "</strong> (" . htmlspecialchars($staff['category']) . ")"; // Added category
                    echo " - <a href='staff_details.php?id=" . $staff['id'] . "' class='details-button'>View Details</a>";
                    echo "</li>";
                }
                ?>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Labour Booking. All Rights Reserved.</p>
    </footer>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
