<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "labour_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$appointment_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $payment_status = ($payment_method === 'online') ? 'done' : 'cash';

    // Insert payment details
    $sql = "INSERT INTO payments (user_id, appointment_id, amount, payment_status) VALUES ('$user_id', '$appointment_id', '$amount', '$payment_status')";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Payment recorded successfully!</p>";
        header("Refresh: 2; url=view_bookings.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pay_advance.css">
    <title>Pay Advance</title>
</head>
<body>
    <nav>
        <div class="sappy">
            <h1>Labour Booking</h1>
            <div class="hi">
                <a href="userhome.php" class="hello">Home</a>
                <a href="view_bookings.php" class="hello">View Bookings</a>
                <a href="logout.php" class="hello">Logout</a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <h2>Pay Advance for Appointment</h2>
        <form action="" method="POST">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>
            
            <h3>Payment Method:</h3>
            <input type="radio" id="cash" name="payment_method" value="cash" checked>
            <label for="cash">Cash</label><br>
            <input type="radio" id="online" name="payment_method" value="online">
            <label for="online">Online</label><br>

            <div id="online-payment-details" style="display: none;">
                <h4>Online Payment Details</h4>
                <label for="card_number">Card Number:</label>
                <input type="text" name="card_number" placeholder="1234 5678 9012 3456">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" name="expiry_date" placeholder="MM/YY">
                <label for="cvv">CVV:</label>
                <input type="text" name="cvv" placeholder="123">
            </div>

            <button type="submit">Submit Payment</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Labour Booking. All Rights Reserved.</p>
    </footer>

    <script>
        // Show/hide online payment details based on selected method
        document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
            elem.addEventListener("change", function(event) {
                const onlinePaymentDetails = document.getElementById("online-payment-details");
                if (event.target.value === "online") {
                    onlinePaymentDetails.style.display = "block";
                } else {
                    onlinePaymentDetails.style.display = "none";
                }
            });
        });
    </script>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
