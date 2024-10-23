<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    // Validate inputs
    if (isset($appointment_id) && isset($status)) {
        // Update the appointment status in the database
        $sql = "UPDATE appointments SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $appointment_id);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the appointments page with a success message
            header("Location: staff_view_appointment.php?success=1");
            exit();
        } else {
            echo "Error updating appointment: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conn);
?>
