<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
$sql = "SELECT a.id, a.work_description, a.status, a.appointment_date, p.amount AS advance_amount, s.Name AS staff_name 
        FROM appointments a 
        JOIN payments p ON a.id = p.appointment_id 
        JOIN staff s ON a.staff_id = s.id 
        WHERE a.user_id = '$user_id'"; 

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="appointment_status.css">
    <title>Appointment Status</title>
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
                <!-- <a href="edit_profile.php" class="hello">Edit Profile</a> -->
                <a href="userprofile.php" class="hello">Edit Profile</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <section class="appointments-list">
            <h3>Your Appointments</h3>
            <ul>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($appointment = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        echo "<strong>Worker Name:</strong> " . htmlspecialchars($appointment['staff_name']) . "<br>";
                        echo "<strong>Work Description:</strong> " . htmlspecialchars($appointment['work_description']) . "<br>";
                        echo "<strong>Advance Amount Paid:</strong> Rs." . htmlspecialchars($appointment['advance_amount']) . "<br>";
                        echo "<strong>Appointment Date:</strong> " . htmlspecialchars($appointment['appointment_date']) . "<br>";
                        echo "<strong>Appointment Status:</strong> " . htmlspecialchars($appointment['status']) . "<br>";
                        echo "</li><hr>";
                    }
                } else {
                    echo "<p>You have no appointments.</p>";
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
