<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Room</title>
    <?php require('inc/links_izzy.php'); ?>
</head>

<?php
require('admin/inc/koneksi_db_izzy.php');
require('inc/header_izzy.php');

if (!isset($_SESSION['user_id_izzy'])) {
    echo "<script>
            alert('You need to log in first!');
            window.location.href='index_izzy.php?show_register=true';
          </script>";
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$IzzyRoomId = $_GET['id'];
$IzzyUserId = $_SESSION['user_id_izzy'];

$IzzyQuery = "SELECT r.id_room_izzy, r.name_izzy, u.name_izzy AS user_name_izzy, u.email_izzy AS user_email_izzy, r.price_izzy
            FROM rooms_izzy r
            INNER JOIN user_izzy u ON u.id_izzy = ?
            WHERE r.id_room_izzy = ?";

$IzzyStmt = mysqli_prepare($con, $IzzyQuery);
mysqli_stmt_bind_param($IzzyStmt, "ii", $IzzyUserId, $IzzyRoomId);
mysqli_stmt_execute($IzzyStmt);
$IzzyResult = mysqli_stmt_get_result($IzzyStmt);

if (mysqli_num_rows($IzzyResult) == 0) {
    die("Room not found!");
}

$IzzyRoom = mysqli_fetch_assoc($IzzyResult);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $IzzyCheckin = $_POST['checkin_izzy'];
    $IzzyCheckout = $_POST['checkout_izzy'];

    $today = date("Y-m-d");

    if ($IzzyCheckin < $today) {
        die("<script>alert('Check-in date cannot be earlier than today!'); history.back();</script>");
    }

    if ($IzzyCheckout <= $IzzyCheckin) {
        die("<script>alert('Check-out date must be later than check-in date!'); history.back();</script>");
    }

    $checkinDate = new DateTime($IzzyCheckin);
    $checkoutDate = new DateTime($IzzyCheckout);
    $interval = $checkinDate->diff($checkoutDate);
    $numberOfNights = $interval->days;

    $totalPrice = $IzzyRoom['price_izzy'] * $numberOfNights;

    $IzzyBookingQuery = "INSERT INTO transaction_izzy (id_room_izzy, id_user_izzy, checkin_izzy, checkout_izzy, total_price_izzy, create_at) 
                        VALUES (?, ?, ?, ?, ?, NOW())";

    $IzzyStmt = mysqli_prepare($con, $IzzyBookingQuery);
    mysqli_stmt_bind_param(
        $IzzyStmt,
        "iissi",
        $IzzyRoomId,
        $IzzyUserId,
        $IzzyCheckin,
        $IzzyCheckout,
        $totalPrice
    );

    if (mysqli_stmt_execute($IzzyStmt)) {
        echo  number_format($totalPrice, 2);
    } else {
        echo "<script>alert('Booking failed. Please try again.');</script>";
    }
}

?>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="fw-bold text-center">Book Room: <?php echo $IzzyRoom['name_izzy']; ?></h2>
        <div class="card shadow p-4 ">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name_izzy" class="form-control" readonly value="<?php echo $IzzyRoom['user_name_izzy']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_izzy" class="form-control" readonly value="<?php echo $IzzyRoom['user_email_izzy']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Room Price</label>
                    <input type="text" class="form-control" readonly id="price_izzy" value="<?php echo $IzzyRoom['price_izzy']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Price</label>
                    <input type="text" class="form-control" readonly id="total_price">
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

                <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
            </form>
        </div>
    </div>

    <?php require('inc/footer_izzy.php'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            let checkinInput = document.getElementById("checkin_izzy");
            let checkoutInput = document.getElementById("checkout_izzy");
            let totalPriceInput = document.getElementById("total_price");

            checkinInput.setAttribute("min", today);

            checkinInput.addEventListener("change", function() {
                let checkinDate = checkinInput.value;

                if (!checkinDate) {
                    alert("Please select a check-in date first!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                    return;
                }
                let minCheckout = new Date(checkinDate);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.setAttribute("min", minCheckout.toISOString().split("T")[0]);

                if (!checkoutInput.value || checkoutInput.value < checkinDate) {
                    checkoutInput.value = checkinDate;
                }
            });

            checkoutInput.addEventListener("change", function() {
                let checkinDate = checkinInput.value;
                let checkoutDate = checkoutInput.value;

                if (!checkinDate) {
                    alert("Please select a check-in date first!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                    return;
                }

                if (checkoutDate <= checkinDate) {
                    alert("Check-out date must be later than check-in date!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                }

                let pricePerNight = <?php echo $IzzyRoom['price_izzy']; ?>;
                let checkin = new Date(checkinDate);
                let checkout = new Date(checkoutDate);
                let nights = (checkout - checkin) / (1000 * 3600 * 24);

                if (nights > 0) {
                    let totalPrice = pricePerNight * nights;
                    totalPriceInput.value = totalPrice.toFixed(2);
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            let checkinInput = document.getElementById("checkin_izzy");
            let checkoutInput = document.getElementById("checkout_izzy");
            let totalPriceInput = document.getElementById("total_price");
            let pricePerNight = <?php echo $IzzyRoom['price_izzy']; ?>;

            checkinInput.setAttribute("min", today);

            checkinInput.addEventListener("change", function() {
                let checkinDate = checkinInput.value;

                if (!checkinDate) {
                    alert("Please select a check-in date first!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                    return;
                }

                // Set check-out minimum date ke sehari setelah check-in
                let minCheckout = new Date(checkinDate);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.setAttribute("min", minCheckout.toISOString().split("T")[0]);

                // Reset total price
                checkoutInput.value = "";
                totalPriceInput.value = "0";
            });

            checkoutInput.addEventListener("change", function() {
                let checkinDate = checkinInput.value;
                let checkoutDate = checkoutInput.value;

                if (!checkinDate) {
                    alert("Please select a check-in date first!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                    return;
                }

                if (checkoutDate <= checkinDate) {
                    alert("Check-out date must be later than check-in date!");
                    checkoutInput.value = "";
                    totalPriceInput.value = "0";
                    return;
                }

                // Hitung total price berdasarkan jumlah malam
                let checkin = new Date(checkinDate);
                let checkout = new Date(checkoutDate);
                let nights = (checkout - checkin) / (1000 * 3600 * 24);

                if (nights > 0) {
                    let totalPrice = pricePerNight * nights;
                    totalPriceInput.value = totalPrice.toFixed(2);
                }
            });
        })
    </script>


</body>

</html>