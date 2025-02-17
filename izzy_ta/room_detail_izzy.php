<?php
require('admin/inc/koneksi_db_izzy.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="htttps://unpkg.com/swiper07/swiper-bundle.min.css">
    <?php require('inc/links_izzy.php'); ?>
</head>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Room ID is required.");
}

$id_room_izzy = intval($_GET['id']);
$query = "SELECT f.feature_name_izzy, fc.facility_name_izzy 
          FROM rooms_izzy r
          JOIN features_izzy f ON r.id_feature_izzy = f.id_feature_izzy
          JOIN facilities_izzy fc ON r.id_facility_izzy = fc.id_facility_izzy
          WHERE r.id_room_izzy = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_room_izzy);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

if (!$room) {
    die("Room not found.");
}
?>


<body>
    <?php require('inc/header_izzy.php'); ?>

    <div class="container">
        <dic class="row">
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="images/rooms/1.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5>Room 1</h5>
                        <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                2 Sofa
                            </span>
                        </div>
                        <div class="faciilities mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                Room Heater
                            </span>
                        </div>
                        <div class="guest">
                            <h6 class="mb-1">Guest</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                2 Children
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                        <h6 class="mb-4"> $100 per night</h6>
                        <a href="booking_izzy.php" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                    </div>
                </div>
            </div>
        </dic>

    </div>

    <?php require('inc/footer_izzy.php'); ?>
</body>

</html>