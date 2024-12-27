<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="adminhome.css">
</head>
<body>
  <?php
  $conn = mysqli_connect("localhost", "root", "", "labour_booking");

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $bookingResult = mysqli_query($conn, "SELECT COUNT(*) as totalBookings FROM appointments");
  $bookingRow = mysqli_fetch_assoc($bookingResult);
  $totalBookings = $bookingRow['totalBookings'];

  $staffResult = mysqli_query($conn, "SELECT COUNT(*) as totalStaff FROM staff");
  $staffRow = mysqli_fetch_assoc($staffResult);
  $totalStaff = $staffRow['totalStaff'];

  $userResult = mysqli_query($conn, "SELECT COUNT(*) as totalUsers FROM users");
  $userRow = mysqli_fetch_assoc($userResult);
  $totalUsers = $userRow['totalUsers'];

  mysqli_close($conn);
  ?>

  <nav>
    <div class="sappy">
      <h1>Admin Home</h1>
      <div class="hi">
        <a href="managebooking.php" class="hello">Manage Booking</a>
        <a href="managestaff.php" class="hello">Manage Staff</a>
        <a href="manageuser.php" class="hello">Manage User</a>
        <a href="managefeedback.php" class="hello">Manage Feedback</a>
        <a href="logout.php" class="hello">Logout</a>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <h2>Welcome to the Labour Booking Admin Panel</h2>
    <p>Here you can manage bookings, staff, and users effectively. Use the links above to navigate.</p>

    <div class="stats">
      <h3>Statistics</h3>
      <div class="stat-item">
        <h4>Total Bookings:</h4>
        <p><?php echo $totalBookings; ?></p>
      </div>
      <div class="stat-item">
        <h4>Total Staff:</h4>
        <p><?php echo $totalStaff; ?></p>
      </div>
      <div class="stat-item">
        <h4>Total Users:</h4>
        <p><?php echo $totalUsers; ?></p>
      </div>
    </div>

    <div class="actions">
      <h3>Quick Actions</h3>
      <ul>
        <li><a href="managebooking.php">Manage Booking</a></li>
        <li><a href="managestaff.php">Add New Staff</a></li>
        <li><a href="manageuser.php">Manage User</a></li>
      </ul>
    </div>
  </div>
</body>
</html>
