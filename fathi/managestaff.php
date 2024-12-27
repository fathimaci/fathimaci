<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="managestaff.css">
</head>
<body>
<nav>
    <div class="sappy">
      <h1>Admin Home</h1>
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

<div class="reg">
    <form action="" class="from" method="post">
        <h1 class="h01">ADD STAFF</h1>
        <input class="cls" type="text" placeholder="Name" name="name" required>
        <input class="cls" type="text" placeholder="Phone No" name="phone_no" required>
        <input class="cls" type="email" placeholder="Email ID" name="email_id" required>
        <input class="cls" type="text" placeholder="Username" name="username" required>
        <input class="cls" type="password" placeholder="Password" name="password" required>
        <select name="category" class="cls" required>
            <option value="">Select Category</option>
            <option value="electrician">Electrician</option>
            <option value="plumber">Plumber</option>
            <option value="painter">Painter</option>
            <option value="helper">Helper</option>
            <option value="architect">Architect</option>
            <option value="civil engineer">Civil Engineer</option>
            <option value="construction worker">Construction Worker</option>
            <option value="bricklayer">Bricklayer</option>
            <option value="ironworker">Ironworker</option>
            <option value="roofer">Roofer</option>
            <option value="tile setter">Tile Setter</option>
        </select>
        <input class="in" type="submit" value="Register" name="submit">
    </form>
</div>

<div>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "labour_booking");
    if (!$conn) {
        echo "Database not connected";
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $phone_no = $_POST['phone_no'];
        $email_id = $_POST['email_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $category = $_POST['category'];

        // Insert staff data
        $sql = "INSERT INTO `staff`(`Name`, `phoneno`, `emailid`, `username`, `password`, `category`) 
                VALUES ('$name', '$phone_no', '$email_id', '$username', '$password', '$category')";
        $data = mysqli_query($conn, $sql);

        // Insert login data
        $sql1 = "INSERT INTO `login`(`emailid`, `password`, `usertype`) VALUES ('$email_id', '$password', 1)";
        $data1 = mysqli_query($conn, $sql1);

        if ($data && $data1) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Invalid record');</script>";
        }
    }

    // Fetch and display staff data
    $sql = "SELECT * FROM staff";
    $data = mysqli_query($conn, $sql);
    if (mysqli_num_rows($data) > 0) {
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Email ID</th>";
        echo "<th>Category</th>";
        echo "<th>Status</th>"; // Display the status column
        echo "<th>Actions</th>"; // Added Actions column
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($data)) {
            $email = $row['emailid'];
            $id = $row['id'];
            $status = $row['status']; // Get current status

            echo "<tr>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['phoneno'] . "</td>";
            echo "<td>" . $row['emailid'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $status . "</td>"; // Display the current status
            echo "<td>
                <form method='POST' style='display:inline;'>
                    <button value='$email' name='updateStatus' type='submit'>" . ($status == 'active' ? 'Deactivate' : 'Activate') . "</button>
                </form>
                <form method='post' action='staffedit.php' style='display:inline;'>
                    <button value='{$id}' name='staffedit' class='deluser' type='submit'>Edit</button>
                </form>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>

    <?php
    // Handle status update
    if (isset($_POST['updateStatus'])) {
        $email = $_POST['updateStatus'];
        if (!empty($email)) {
            // Get current status of the user
            $sql = "SELECT status FROM staff WHERE emailid='$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $currentStatus = $row['status'];

            // Toggle status between 'active' and 'inactive'
            $newStatus = ($currentStatus == 'active') ? 'inactive' : 'active';

            // Update status
            $updateSql = "UPDATE staff SET status='$newStatus' WHERE emailid='$email'";
            $updateData = mysqli_query($conn, $updateSql);

            if ($updateData) {
                echo "<script>window.location.replace('managestaff.php');</script>";
            } else {
                echo "<script>alert('Error updating status');</script>";
            }
        }
    }
    ?>
</div>
</body>
</html>
