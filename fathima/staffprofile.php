<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$staff_id = $_SESSION['staff_id']; 

// Fetch staff details
$sql = "SELECT * FROM staff WHERE id = $staff_id"; 
$result = mysqli_query($conn, $sql);
$staff = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    
    // Store the old email for updating the login table
    $old_email = $staff['emailid'];

    // Update staff details
    $update_sql = "UPDATE staff SET Name='$name', emailid='$email', phoneno='$phone', category='$category' WHERE id=$staff_id";

    if (mysqli_query($conn, $update_sql)) {
        // Update login table with the new email
        $update_login_sql = "UPDATE login SET emailid='$email' WHERE emailid='$old_email'";

        if (mysqli_query($conn, $update_login_sql)) {
            echo "<p>Profile updated successfully!</p>";
            header('Location: staffprofile.php');
        } else {
            echo "<p>Error updating login table: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>Error updating profile: " . mysqli_error($conn) . "</p>";
    }

    // Fetch updated staff details
    $result = mysqli_query($conn, $sql);
    $staff = mysqli_fetch_assoc($result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staffprofile.css">
    <title>Edit Profile</title>
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
        <header class="header">
            <h2>Edit Profile</h2>
        </header>

        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($staff['Name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($staff['emailid']); ?>" required>

            <label for="phone">Contact Number:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($staff['phoneno']); ?>" required>

            <label for="category">Skills/Category:</label>
            <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($staff['category']); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Labour Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>
