<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feedback</title>
    <link rel="stylesheet" href="managefeedback.css">
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
        <a href="managefeedback.php" class="hello">Manage Feedback</a>
        <a href="logout.php" class="hello">Logout</a>
      </div>
    </div>
  </nav>

  <h1 class="man" >Manage Feedback</h1>

  <table>
    <thead>
      <tr>
        <th>Feedback ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Connect to the database
      $conn = mysqli_connect("localhost", "root", "", "labour_booking");

      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      // Fetch all feedback entries
      $result = mysqli_query($conn, "SELECT * FROM feedback");

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['feedback_id'] . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['message'] . "</td>";
              echo "<td>" . $row['feedback_date'] . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='5'>No feedback found</td></tr>";
      }

      mysqli_close($conn);
      ?>
    </tbody>
  </table>

</body>
</html>
