<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manageuser</title>
    <link rel="stylesheet" href="manageuser.css">

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
  <div class="fathima"></div>
<div class="design">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "labour_booking");
    if(!$conn){
        echo "Database not connected";
    }

    $sql = "SELECT * FROM users";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){
    
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Email ID</th>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "<th>usid</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        while($row=mysqli_fetch_assoc($data)){
            $email = $row['email_id'];
            $id = $row['usid'];
            echo "<tr>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['phone_no']."</td>";
            echo "<td>".$row['email_id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td>".$row['usid']."</td>";
            echo "<td>
                    <form method='POST'>
                        <button value='$email' name='userdel' type='submit'>Delete</button>
                    </form>
                </td>";
            echo "</tr>";
            echo "</tr>";

        }
        echo "</table>";

    }
?>
        </div>
</body>
</html>
<?php
 if(!$conn){
    echo "Database not connected";
}

if(isset($_POST['userdel'])){
    $email = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM users WHERE email_id='$email'";
        $data = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM login WHERE email_id='$email'";
        $data1 = mysqli_query($conn, $sql1);
         echo "<script>window.location.replace(manageuser.php');</script>";
    }
}
?>

 