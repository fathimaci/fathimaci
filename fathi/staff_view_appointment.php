<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$staff_id = $_SESSION['staff_id']; 
$sql = "SELECT a.id, a.work_description, a.appointment_date, a.status, u.Name as user_name 
        FROM appointments a 
        JOIN users u ON a.user_id = u.usid 
        WHERE a.staff_id = '$staff_id'"; 

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staffdash.css">
    <title>Your Appointments</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="staffdash.php" class="hello">Dashboard</a>
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
                        echo "<strong>User:</strong> " . htmlspecialchars($appointment['user_name']) . "<br>";
                        echo "<strong>Work Description:</strong> " . htmlspecialchars($appointment['work_description']) . "<br>";
                        echo "<strong>Appointment Date:</strong> " . htmlspecialchars($appointment['appointment_date']) . "<br>";
                        echo "<strong>Status:</strong> " . htmlspecialchars($appointment['status']) . "<br>";

                        // Status change buttons
                        if ($appointment['status'] === 'pending') {
                            echo "<form action='update_appointment.php' method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='appointment_id' value='" . $appointment['id'] . "'>";
                            echo "<button style='margin-right:10px;' type='submit' name='status' value='confirmed' class='status-button confirmed'>Confirm</button>";
                            echo "<button type='submit' name='status' value='canceled' class='status-button canceled'>Cancel</button>";
                            echo "</form>";
                        }
                        
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
