<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Booking</title>
    <link rel="stylesheet" href="managebooking.css"> 
</head>
<body>

  <nav>
    <div class="sappy">
      <h1 class="ad" >Admin Home</h1>
      <div class="hi">
        <a href="adminhome.php" class="hello">Dashboard</a>
        <a href="managebooking.php" class="hello">Manage Booking</a>
        <a href="managestaff.php" class="hello">Manage Staff</a>
        <a href="manageuser.php" class="hello">Manage User</a>
        <a href="managefeedback.php" class="hello">Manage feedback</a>
        <a href="logout.php" class="hello">Logout</a>
      </div>
    </div>
  </nav>

  <h1 class="man" >Manage Bookings</h1>

  <table>
    <thead>
      <tr>
        <th>Booking ID</th>
        <th>User ID</th>
        <th>Staff ID</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $conn = mysqli_connect("localhost", "root", "", "labour_booking");

      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $result = mysqli_query($conn, "SELECT * FROM appointments");

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['id'] . "</td>";
              echo "<td>" . $row['user_id'] . "</td>";
              echo "<td>" . $row['staff_id'] . "</td>";
              echo "<td>" . $row['appointment_date'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='5'>No bookings found</td></tr>";
      }

      mysqli_close($conn);
      ?>
    </tbody>
  </table>

</body>
</html>
