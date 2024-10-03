<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
      <nav>
    <div class="sappy">
      <h1>labour booking</h1>
      <div class="hi">
      <a href="login.php" class="hello">login</a>
      <a href="register.php" class="hello">register</a>
      <a href="" class="hello">feedback</a>
      </div>
    </div>
  </nav>
    <div class="reg">
    <form action="" class="from" method="post">
        <h1 class="jo">REGISTER</h1>
        <!-- <label class="cls2">Name:</label> -->
        <input class="cls" type="text" placeholder="Name" name="name">
        <!-- <label class="cls2">phone no:</label> -->
        <input class="cls" type="text" placeholder="phone no" name="phone_no">
        <!-- <label class="cls2">email_id:</label> -->
        <input class="cls" type="text" placeholder="email id" name="email_id">
        <!-- <label class="cls2">username:</label> -->
        <input class="cls" type="text" placeholder="username" name="username">
        <!-- <label class="cls2">password:</label> -->
        <input class="cls" type="text" placeholder="password" name="password">
        <input class="in" type="submit" value="register" name="submit">
    </form>
   </div>
</body>
</html>


<?php
$con=mysqli_connect("localhost","root","","labour_booking");
if(!$con)
{
  echo"database not connected";
}
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$phone_no=$_POST['phone_no'];
$email_id=$_POST['email_id'];
$username=$_POST['username'];
$password=$_POST['password'];
$sql="INSERT INTO `users`(`Name`, `phone_no`, `email_id`, `username`, `password`) VALUES ('$name','$phone_no','$email_id','$username','$password')";
$data=mysqli_query($con,$sql);
$sql1="INSERT INTO `login`( `emailid`, `password`,`usertype`) VALUES ('$email_id','$password',0)";
$data1=mysqli_query($con,$sql1);
if($data && $data1)
{
  echo"<script>alert('record added')</script>";
}else{
  echo"<script>alert('invalid record')</script>";
}
}
else{
  echo"query failed";
}
?>
