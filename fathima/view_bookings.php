<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id']; 
$sql = "SELECT a.id, a.work_description, a.appointment_date, a.status, s.Name as staff_name 
        FROM appointments a 
        JOIN staff s ON a.staff_id = s.id 
        WHERE a.user_id = '$user_id'"; 

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewbookings.css">
    <title>Your Bookings</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="userhome.php" class="hello">Home</a>
                <a href="view_service_providers.php" class="hello">View Service Providers</a>
                <a href="view_bookings.php" class="hello">View Booking Appointments</a>
                <!-- <a href="statistics.php" class="hello">Statistics</a> -->
                <a href="edit_profile.php" class="hello">Edit Profile</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>
    <main class="main-content">
        <section class="bookings-list">
            <h3>Your Appointments</h3>
            <ul>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($booking = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        echo "<strong>Staff:</strong> " . htmlspecialchars($booking['staff_name']) . "<br>";
                        echo "<strong>Work Description:</strong> " . htmlspecialchars($booking['work_description']) . "<br>";
                        echo "<strong>Appointment Date:</strong> " . htmlspecialchars($booking['appointment_date']) . "<br>";
                        echo "<strong>Status:</strong> " . htmlspecialchars($booking['status']) . "<br>";

                        // Show "Pay Advance" button if status is confirmed
                        if ($booking['status'] === 'confirmed') {
                            echo "<a href='pay_advance.php?id=" . $booking['id'] . "' class='pay-button'>Pay Advance</a>";
                        }
                        
                        echo "</li><hr>";
                    }
                } else {
                    echo "<p>You have no bookings.</p>";
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
