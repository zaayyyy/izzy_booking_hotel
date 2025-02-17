<?php
require('admin/inc/koneksi_db_izzy.php');

if (!isset($_SESSION['user_id_izzy'])) {
    echo "<script>
            alert('You need to log in first!');
            window.location.href='index.php?show_register=true';
          </script>";
    exit;
}


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$IzzyRoomId = $_GET['id'];

$IzzyQuery = "SELECT * FROM rooms_izzy WHERE id_room_izzy = ?";
$IzzyStmt = mysqli_prepare($con, $IzzyQuery);
mysqli_stmt_bind_param($IzzyStmt, "i", $IzzyRoomId);
mysqli_stmt_execute($IzzyStmt);
$IzzyResult = mysqli_stmt_get_result($IzzyStmt);

if (mysqli_num_rows($IzzyResult) == 0) {
    die("Room not found!");
}

$IzzyRoom = mysqli_fetch_assoc($IzzyResult);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $IzzyUserName = $_POST['name_izzy'];
    $IzzyUserEmail = $_POST['email_izzy'];
    $IzzyCheckin = $_POST['checkin_izzy'];
    $IzzyCheckout = $_POST['checkout_izzy'];
    $IzzyGuests = $_POST['guests_izzy'];
    $IzzyTotalPrice = $_POST['total_price_izzy']; 


    $IzzyBookingQuery = "INSERT INTO bookings_izzy (room_id_izzy, id_user_izzy, checkin_izzy, checkout_izzy, guests_izzy, total_price_izzy, status_izzy)
                         VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
    
    $IzzyStmt = mysqli_prepare($con, $IzzyBookingQuery);
    mysqli_stmt_bind_param($IzzyStmt, "issssii", $IzzyRoomId, $IzzyUserName, $IzzyUserEmail, $IzzyCheckin, $IzzyCheckout, $IzzyGuests, $IzzyTotalPrice);
    
    if (mysqli_stmt_execute($IzzyStmt)) {
        echo "<script>alert('Booking successful! We will confirm your reservation shortly.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Room</title>
    <?php require('inc/links_izzy.php'); ?>
</head>

<body class="bg-light">
    <?php require('inc/header_izzy.php'); ?>

    <div class="container mt-5">
        <h2 class="fw-bold text-center">Book Room: <?php echo $IzzyRoom['name_izzy']; ?></h2>
        <div class="card shadow p-4">
            <form method="POST">
                <input type="hidden" name="total_price_izzy" id="total_price_izzy">
                
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name_izzy" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_izzy" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Check-in Date</label>
                        <input type="date" name="checkin_izzy" id="checkin_izzy" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Check-out Date</label>
                        <input type="date" name="checkout_izzy" id="checkout_izzy" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Guests</label>
                    <input type="number" name="guests_izzy" class="form-control" required>
                </div>

                <div class="mb-3">
                    <h5>Total Price: $<span id="IzzyPriceDisplay"><?php echo $IzzyRoom['price_izzy']; ?></span></h5>
                </div>

                <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
            </form>
        </div>
    </div>

    <?php require('inc/footer_izzy.php'); ?>

    <script>
        document.getElementById("checkin_izzy").addEventListener("change", calculatePrice);
        document.getElementById("checkout_izzy").addEventListener("change", calculatePrice);

        function calculatePrice() {
            let checkin = new Date(document.getElementById("checkin_izzy").value);
            let checkout = new Date(document.getElementById("checkout_izzy").value);
            let pricePerNight = <?php echo $IzzyRoom['price_per_night_izzy']; ?>;

            if (checkin && checkout && checkin < checkout) {
                let nights = (checkout - checkin) / (1000 * 60 * 60 * 24);
                let totalPrice = nights * pricePerNight;

                document.getElementById("IzzyPriceDisplay").innerText = totalPrice;
                document.getElementById("total_price_izzy").value = totalPrice;
            }
        }
    </script>
</body>

</html>
