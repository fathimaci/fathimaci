<html>
<head>  
    <link rel="stylesheet" href="staffedit.css">
    <title>LOGIN</title>
</head>
<body>
    <nav class="nanbar">
        <div class="navbar">
            <a href="#">LABOUR BOOKING WEBSITE</a>
            <div class="link">
                <a href="mamnagestaff.php">home</a>
                <a href="adminhome.html">Dashboard</a>
            </div>
        </div>
    </nav>
    <div class="div2">
        <h1 class="naj">MANAGE STAFF</h1>
        <?php
        // Check if 'staffedit' is set in the POST request
        if (isset($_POST['staffedit'])) {
            $id = $_POST['staffedit'];
            $conn = mysqli_connect("localhost", "root", "", "labour_booking");

            // Check for successful database connection
            if ($conn) {
                // Fetch staff details from the database
                $sql = $conn->query("SELECT * FROM staff WHERE id='$id'");
                $userDetails = $sql->fetch_assoc();

                // Check if form has been submitted for updating the staff details
                if (isset($_POST['register'])) {
                    $name = $_POST['name'];
                    $phoneno = $_POST['phoneno'];
                    $emailid = $_POST['emailid'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $category = $_POST['category'];

                    // Check if the email has been changed
                    if ($emailid != $userDetails['emailid']) {
                        // Update the email in the login table if the email has changed
                        $updateLoginSql = "UPDATE login SET emailid='$emailid' WHERE emailid='" . $userDetails['emailid'] . "'";
                        $conn->query($updateLoginSql);
                    }

                    // Update the staff details in the staff table
                    $profileUpdateSql = $conn->query("UPDATE `staff` SET `Name`='$name',`phoneno`='$phoneno',`emailid`='$emailid',`username`='$username',`password`='$password',`category`='$category' WHERE id='$id'");            

                    if ($profileUpdateSql) {
                        echo "<script>alert('Update successful'); window.location.href = 'managestaff.php';</script>";
                        exit();
                    } else {
                        echo "<script>alert('Update Failed')</script>";
                    }
                }
            } }else {
                echo "Database connection failed.";
            }   
        ?>
        <form method="post">
            <div class="div3">
            <input type="hidden" name="staffedit" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr>
                    <td>Staff Name:</td>
                    <td><input  class="inp" type="text" name="name" value="<?php echo htmlspecialchars($userDetails['Name']); ?>" placeholder="Fullname"><br></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input  class="inp" type="text" name="phoneno" value="<?php echo htmlspecialchars($userDetails['phoneno']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Email-ID:</td>
                    <td><input  class="inp" type="email" name="emailid" value="<?php echo htmlspecialchars($userDetails['emailid']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><input  class="inp" type="text" name="category" value="<?php echo htmlspecialchars($userDetails['category']); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button id="hero_bt" type="submit" name="register">Update</button></td>
                </tr>
            </table>
        </div>
            
        </form>
    
</body>
</html>
