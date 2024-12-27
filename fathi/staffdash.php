<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch staff details based on session user_id
$staff_id = $_SESSION['staff_id']; // Assuming staff_id is stored in the session
$sql = "SELECT * FROM staff WHERE id = $staff_id"; 
$result = mysqli_query($conn, $sql);
$staff = mysqli_fetch_assoc($result);

if (!$staff) {
    echo "Staff not found.";
    exit();
}

$appointments_sql = "SELECT a.*, u.Name as user_name FROM appointments a 
                     JOIN users u ON a.user_id = u.usid 
                     WHERE a.staff_id = $staff_id 
                     AND a.appointment_date >= CURDATE()"; 
$appointments_result = mysqli_query($conn, $appointments_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staffdash.css">
    <title>Staff Dashboard</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="staffdash.php" class="hello">Dashboard</a>
                <a href="staff_view_appointment.php" class="hello">View Appointments</a>
                <a href="staffprofile.php" class="hello">Edit Profile</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <header class="header">
        <h2>Welcome, <?php echo htmlspecialchars($staff['Name']); ?></h2>
    </header>

    <main class="main-content">
        <section class="staff-info">
            <h3>Your Information</h3>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($staff['emailid']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($staff['phoneno']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($staff['category']); ?></p>
        </section>

        <section class="appointments-list">
            <h3>Your Upcoming Appointments</h3>
            <ul>
                <?php
                if (mysqli_num_rows($appointments_result) > 0) {
                    while ($appointment = mysqli_fetch_assoc($appointments_result)) {
                        echo "<li>";
                        echo "<strong>User:</strong> " . htmlspecialchars($appointment['user_name']) . "<br>";
                        echo "<strong>Work Description:</strong> " . htmlspecialchars($appointment['work_description']) . "<br>";
                        echo "<strong>Date:</strong> " . htmlspecialchars($appointment['appointment_date']) . "<br>";
                        echo "<strong>Status:</strong> " . htmlspecialchars($appointment['status']) . "<br>";
                        echo "</li><hr>";
                    }
                } else {
                    echo "<p>You have no upcoming appointments.</p>";
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
