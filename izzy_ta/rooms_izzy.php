<?php
require('admin/inc/koneksi_db_izzy.php');
$IzzyQuery = "SELECT * FROM rooms_izzy";
$IzzyResult = mysqli_query($con, $IzzyQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="htttps://unpkg.com/swiper07/swiper-bundle.min.css">
    <?php require('inc/links_izzy.php'); ?>
</head>

<body class="bg-light">
    <?php require('inc/header_izzy.php'); ?>
    <?php if (mysqli_num_rows($IzzyResult) == 0) {
        echo "<p class='text-center'>No rooms available.</p>";
    } else {
        while ($IzzyRow = mysqli_fetch_assoc($IzzyResult)) { ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
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
                                    <label class="form-check-label" for="f2">Facility teo</label>
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

            <div class="col-lg-9 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/rooms/1.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5><?php echo $IzzyRow['name_izzy']; ?></h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['id_feature_izzy']; ?>
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['id_facility_izzy']; ?>
                                </span>
                            </div>
                            <div class="guest">
                                <h6 class="mb-1">Guest</h6>
                                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    <?php echo $IzzyRow['guest_capacity_izzy']; ?> Guests
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">$<?php echo $IzzyRow['price_izzy']; ?> per night</h6>
                            <a href="booking_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            <a href="room_detail_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } ?>
            </div>
        </div>
    </div>

    <?php require('inc/footer_izzy.php'); ?>

</body>

</html>