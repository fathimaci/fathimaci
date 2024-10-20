<?php
session_start();
if (!isset($_GET['username'])) {
    header("Location: register.php");
    exit();
}

$username = htmlspecialchars($_GET['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <p>Your registration was successful. You can now <a href="login.php">login</a>.</p>
</body>
</html>
