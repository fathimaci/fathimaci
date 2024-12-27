<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch staff details based on the ID from the URL
$staff_id = $_GET['id'];
$sql = "SELECT * FROM staff WHERE id = $staff_id"; // Assuming 'id' is the primary key
$result = mysqli_query($conn, $sql);
$staff = mysqli_fetch_assoc($result);

if (!$staff) {
    echo "Staff not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staffdetail.css">
    <title>Staff Details</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="userhome.php" class="hello">Home</a>
                <a href="view_service_providers.php" class="hello">View Service Providers</a>
                <a href="view_bookings.php" class="hello">View Booking Appointments</a>
                <a href="statistics.php" class="hello">Statistics</a>
                <a href="edit_profile.php" class="hello">Edit Profile</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <header class="header">
        <h2><?php echo htmlspecialchars($staff['Name']); ?>'s Details</h2>
    </header>

    <main class="main-content">
        <section class="staff-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($staff['Name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($staff['emailid']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($staff['phoneno']); ?></p>
            <p><strong>Skills:</strong> <?php echo htmlspecialchars($staff['category']); ?></p>
        </section>

        <section class="appointment-form">
            <h3>Book an Appointment</h3>
            <form action="book_appointment.php" method="POST">
                <input type="hidden" name="staff_id" value="<?php echo $staff['id']; ?>">
                <label for="work_description">Describe your work:</label>
                <textarea name="work_description" required></textarea>

                <label for="appointment_date">Select Date:</label>
                <input type="date" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>">

                <button type="submit">Book Appointment</button>
            </form>
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
