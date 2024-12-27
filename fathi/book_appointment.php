<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = $_POST['staff_id'];
    $work_description = $_POST['work_description'];
    $appointment_date = $_POST['appointment_date'];
    $user_id = $_SESSION['user_id']; 

    $sql = "INSERT INTO appointments (user_id, staff_id, work_description, appointment_date, status) 
            VALUES ('$user_id', '$staff_id', '$work_description', '$appointment_date', 'pending')";

    if (mysqli_query($conn, $sql)) {
        echo "Appointment booked successfully.";
        header("Location: view_bookings.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
