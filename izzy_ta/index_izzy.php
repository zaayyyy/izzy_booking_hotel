<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links_izzy.php'); ?>
    <link rel="stylesheet" href="htttps://unpkg.com/swiper07/swiper-bundle.min.css">
    <style>
        .availibility-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availibility-form {
                margin-top: 0px;
                padding: 0 35px;
            }
        }
    </style>
</head>

<body class="bg-light">

    <?php require('inc/header_izzy.php'); ?>

    <!-- swiper -->
    <div class="continer-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/carousel/1.png" class="w-100 d-blok" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/2.png" class="w-100 d-blok" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/3.png" class="w-100 d-blok" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/4.png" class="w-100 d-blok" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/5.png" class="w-100 d-blok" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/6.png" class="w-100 d-blok" />
                </div>
            </div>
        </div>
    </div>

    <!-- Booking -->
    <div class="container availibility-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availibility</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2 ">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- our rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <?php
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
            if (mysqli_num_rows($IzzyResult) == 0) {
                echo "<p class='text-center'>Room Not Found.</p>";
            } else {
                while ($IzzyRow = mysqli_fetch_assoc($IzzyResult)) { ?>
                    <div class=" col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                            <img src="images/rooms/1.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5><?php echo $IzzyRow['name_izzy']; ?></h5>
                                <h6 class="mb-4">$<?php echo $IzzyRow['price_izzy']; ?> per night</h6>
                                <div class="features mb-4">
                                    <h6 class="mb-1">Room Type</h6>
                                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                        <?php echo $IzzyRow['type_izzy']; ?>
                                    </span>
                                </div>
                                <div class="faciilities mb-4">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                        <?php echo $IzzyRow['add_name_izzy']; ?>
                                    </span>
                                </div>
                                <div class="guest mb-4">
                                    <h6 class="mb-1">Guest</h6>
                                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                        <?php echo $IzzyRow['guest_capacity_izzy']; ?> Guests
                                    </span>
                                </div>
                                <div class="rating mb-4">
                                    <h6 class="mb-1">Rating</h6>
                                    <span class="badge rounded-pill bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-evenly mb-2">
                                    <?php if (isset($_SESSION['user_id_izzy'])): ?>
                                        <a href="booking_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>"
                                            class="btn btn-sm text-white custom-bg shadow-none ">Book Now</a>
                                    <?php else: ?>
                                        <button type="button"
                                            class="btn btn-sm text-white custom-bg shadow-none book-now-btn"
                                            data-room-id="<?php echo $IzzyRow['id_room_izzy']; ?>">Book Now</button>
                                    <?php endif; ?>
                                    <a href="room_detail_izzy.php?id=<?php echo $IzzyRow['id_room_izzy']; ?>"
                                        class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                                </div>

                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms_izzy.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More
                    Facilities>>></a>
            </div>
        </div>
    </div>

    <!-- Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/wifi.svg" width="80px">
                <h5 class="mt-3">Wifi</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More
                    Facilities>>></a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
    <div class="container mb-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mt-5">

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/features/star.cvg" width="30px">
                        <h6 class="m-0 mb-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem odit ab dolor nostrum
                        magni. Hic,
                        tempora? Reiciendis accusantium quae rerum.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/features/star.cvg" width="30px">
                        <h6 class="m-0 mb-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem odit ab dolor nostrum
                        magni. Hic,
                        tempora? Reiciendis accusantium quae rerum.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/features/star.cvg" width="30px">
                        <h6 class="m-0 mb-2">Random user1</h6>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem odit ab dolor nostrum
                        magni. Hic,
                        tempora? Reiciendis accusantium quae rerum.
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More>>></a>
        </div>
    </div>

    <!-- Reach us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100" height="320px"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126755.95286184853!2d107.53859397141112!3d-6.875800267703981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e4732a4213a1%3A0x477ac5214225cf2c!2sSMK%20Negeri%202%20Cimahi!5e0!3m2!1sid!2sid!4v1739451301248!5m2!1sid!2sid"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel: +62091011091" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i>+62091011091
                    </a>
                    <br>
                    <a href="tel: +62091011091" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i>+62091011091
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow us</h5>
                    <a href="tel: +62091011091" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 ps-2">
                            <i class="bi bi-twitter-x me-1"></i>Twitter
                        </span>
                    </a>
                    <br>
                    <a href="tel: +62091011091" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 ps-2">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </span>
                    </a>
                    <br>
                    <a href="tel: +62091011091" class="d-inline-block">
                        <span class="badge bg-light text-dark fs-6 ps-2">
                            <i class="bi bi-instagram me-1"></i>Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer_izzy.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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

        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
</body>

</html>