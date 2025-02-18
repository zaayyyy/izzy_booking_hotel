<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <?php require_once('inc/links_izzy.php'); ?>
    <title>Rooms - Izzy Hotel</title>
</head>

<body class="bg-light">
    <?php
require_once('admin/inc/koneksi_db_izzy.php');
require('inc/header_izzy.php');

$IzzyUserLoggedIn = isset($_SESSION['user_id_izzy']);
$IzzyQuery = "SELECT 
    r.id_room_izzy, 
    r.name_izzy, 
    r.guest_capacity_izzy, 
    r.price_izzy, 
    r.room_status_izzy, 
    t.type_izzy, 
    f.add_name_izzy
FROM rooms_izzy r
INNER JOIN room_type_izzy t ON r.id_type_izzy = t.id_type_izzy
INNER JOIN add_facilities_izzy f ON r.id_add_izzy = f.id_add_izzy
";
$IzzyResult = mysqli_query($con, $IzzyQuery);
?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdowm" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdowm">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 10px;">CHECK AVAILIBILITY</h5>
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 10px;">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f1">Facility one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f2">Facility two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f3">Facility three</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 10px;">GUEST</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Adult</label>
                                        <input type="number" class="form-control shadow-none mb-3">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Rooms Display -->
            <div class="col-lg-9 col-md-12 px-4">
                <?php
        if (mysqli_num_rows($IzzyResult) == 0) {
            echo "<p class='text-center'>Room Not Found.</p>";
        } else {
            while ($IzzyRow = mysqli_fetch_assoc($IzzyResult)) { ?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p- align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/rooms/<?php echo isset($IzzyRow['image_field']) ? $IzzyRow['image_field'] : '1.jpg'; ?>"
                                class="img-fluid rounded-start " alt="Room Image">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0 mt-3 align-items-center">
                            <h5><?php echo $IzzyRow['name_izzy']; ?></h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Room Type</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['type_izzy']; ?>
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['add_name_izzy']; ?>
                                </span>
                            </div>
                            <div class="guest mb-3">
                                <h6 class="mb-1">Guest</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['guest_capacity_izzy']; ?> Guests
                                </span>
                            </div>
                            <div class="status">
                                <h6 class="mb-1">Status Room</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['room_status_izzy']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">$<?php echo $IzzyRow['price_izzy']; ?> per night</h6>
                            <?php if(isset($_SESSION['user_id_izzy'])): ?>
                            <a href="booking_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            <?php else: ?>
                            <button type="button"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2 book-now-btn"
                                data-room-id="<?php echo $IzzyRow['id_room_izzy']; ?>">Book Now</button>
                            <?php endif; ?>
                            <a href="room_detail_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>"
                                class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
                <?php }
        } ?>
            </div>
        </div>
    </div>
    
    <?php require_once('inc/footer_izzy.php'); ?>
    <!-- Script untuk menampilkan modal login jika user belum login -->
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

</body>

</html>