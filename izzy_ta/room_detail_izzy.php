<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <?php require('inc/links_izzy.php'); ?>
    <title>Room Details - Izzy Hotel</title>
</head>
<?php
require_once('admin/inc/koneksi_db_izzy.php');
require_once('inc/header_izzy.php');

$IzzyUserLoggedIn = isset($_SESSION['user_id_izzy']);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Room ID is required.");
}

$id_room_izzy = intval($_GET['id']);

$IzzyQuery = "SELECT r.id_room_izzy, r.name_izzy, r.guest_capacity_izzy, 
              r.price_izzy, r.room_status_izzy, t.type_izzy, f.add_name_izzy 
              FROM rooms_izzy r
              INNER JOIN room_type_izzy t ON r.id_type_izzy = t.id_type_izzy
              INNER JOIN add_facilities_izzy f ON r.id_add_izzy = f.id_add_izzy
              WHERE r.id_room_izzy = ?";

$stmt = $con->prepare($IzzyQuery);
$stmt->bind_param("i", $id_room_izzy);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

if (!$room) {
    die("<h3 class='text-center text-danger'>Room Not Found.</h3>");
}

?>

<body class="bg-light">

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ROOM DETAILS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="images/rooms/<?php echo isset($room['image_field']) ? $room['image_field'] : '1.jpg'; ?>"
                            class="img-fluid rounded-start" alt="Room Image">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5><?php echo $room['name_izzy']; ?></h5>
                        <div class="features mb-3">
                            <h6 class="mb-1">Room Type</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                <?php echo $room['type_izzy']; ?>
                            </span>
                        </div>
                        <div class="facilities mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                <?php echo $room['add_name_izzy']; ?>
                            </span>
                        </div>
                        <div class="guest mb-3">
                            <h6 class="mb-1">Guest</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                <?php echo $room['guest_capacity_izzy']; ?> Guests
                            </span>
                        </div>
                        <div class="status">
                            <h6 class="mb-1">Status</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                <?php echo $room['room_status_izzy']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                        <h6 class="mb-4">$<?php echo $room['price_izzy']; ?> per night</h6>
                        <?php if(isset($_SESSION['user_id_izzy'])): ?>
                        <a href="booking_izzy.php?id=<?php echo $room['id_room_izzy']; ?>"
                            class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                        <?php else: ?>
                        <button type="button"
                            class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2 book-now-btn"
                            data-room-id="<?php echo $room['id_room_izzy']; ?>">Book Now</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script: Jika user belum login, tombol Book Now akan memunculkan modal LOGIN -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var bookNowButtons = document.querySelectorAll('.book-now-btn');
        bookNowButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var loginModal = new bootstrap.Modal(document.getElementById('login'));
                loginModal.show();
            });
        });
    });
    </script>

    <?php require('inc/footer_izzy.php'); ?>

</body>

</html>