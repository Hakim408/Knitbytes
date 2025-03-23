<?php require_once('config.php'); ?>
<?php 
if(isset($_SESSION['msg_status'])){
   $msg_status = $_SESSION['msg_status'];
   unset($_SESSION['msg_status']);
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
   $data = '';
   foreach($_POST as $k => $v){
      if(!empty($data)) $data .= " , ";
      $data .= " `{$k}` = '{$v}' ";
   }
   $sql  = "INSERT INTO `messages` set {$data}";
   $save = $conn->query($sql);
   if($save){
      $msg_status = "success";
      foreach($_POST as $k => $v){
         unset($_POST[$k]);
      }
      $_SESSION['msg_status'] = $msg_status;
      header('location:'.$_SERVER['HTTP_REFERER']);
   }else{
      $msg_status = "failed";
      echo "<script>console.log('".$conn->error."')</script>";
      echo "<script>console.log('Query','".$sql."')</script>";
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<head>
    <meta charset="utf-8">
    <title>KnitBytes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="min-height: 100px;">
    <a href="index.php" class="navbar-brand p-0 d-flex align-items-center" style="min-height: 100px; max-height: none;">
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" 
         alt="Logo" 
         style="height: 100px !important; width: auto; max-height: none; object-fit: contain;">
    <div class="ms-1 d-flex flex-column justify-content-center" style="margin-top: 10px;"> 
        <h3 class="m-0" style="font-weight: bold; color: white; font-size: 22px; font-family: 'Saira', sans-serif;">Knit Bytes</h3>
        <small style="font-size: 10px; color: white; opacity: 0.9; font-family: 'Saira', sans-serif; margin-left: 14px;">Digital Solutions</small>
    </div>
</a>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <a href="team.php" class="nav-item nav-link">Our Team</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <a href="contact.php" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Apply For Internship</a>
        </div>
    </nav>
</div>


          
          <?php 
$u_qry = $conn->query("SELECT * FROM users WHERE id = 1");
foreach ($u_qry->fetch_array() as $k => $v) {
    if (!is_numeric($k)) {
        $user[$k] = $v;
    }
}
$c_qry = $conn->query("SELECT * FROM contacts");
while ($row = $c_qry->fetch_assoc()) {
    $contact[$row['meta_field']] = $row['meta_value'];
}
?>
<div class="container-xxl bg-light hero-header">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
        <div class="col-lg-6 text-center text-lg-start" style=" font-family: 'Saira', sans-serif;">
    <h1 class="text-black pb-3 animated slideInDown" style=" font-family: 'Saira', sans-serif;">
        <?php echo $_settings->info('name') ?>
    </h1>
    <p class="text-black pb-3 animated slideInDown" style="text-align: justify;" style=" font-family: 'Saira', sans-serif;">
        <?php echo stripslashes($_settings->info('welcome_message')) ?>
    </p>
    <a href="#" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft" style="font-family: 'Saira', sans-serif; background-color: #022b60; border-color: #022b60;">
    Read More
</a>
<a href="contact.php" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill animated slideInRight" style="font-family: 'Saira', sans-serif; background-color: #022b60; border-color: #022b60;">
    Contact Us
</a>

</div>

            <div class="col-lg-6 text-center"> 
                <img src="<?php echo validate_image($_settings->info('banner')); ?>" alt="Banner Image" class="hero-image img-fluid">
            </div>
        </div>
    </div>
</div>

        <!-- Navbar & Hero End -->


     <!-- Feature Start -->
<!-- Feature Start -->
<div class="container-xxl py-5">
    <div class="container py-5 px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif;margin-top: -100px;">
                <span></span>Our Services<span></span>
            </p>
            <h1 class="text-center mb-5" style=" font-family: 'Saira', sans-serif;">What Solutions We Provide</h1>
        </div>

        <!-- Swiper Slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php 
                    // Fetch services from the database
                    $e_qry = $conn->query("SELECT * FROM services ORDER BY title ASC");
                    while($row = $e_qry->fetch_assoc()):
                ?>
                <div class="swiper-slide">
                    <div class="feature-item bg-light rounded text-center p-4 shadow">
                        <!-- Dynamically fetch and display the icon or image -->
                        <img src="<?php echo validate_image($row['file_path']) ?>" 
                             alt="<?php echo $row['title'] ?>" class="img-fluid mb-4" 
                             style="width: 100px; height: 100px;">
                        
                        <h5 class="mb-3"><?php echo $row['title'] ?></h5>
                        <p class="m-0"><?php echo stripslashes(html_entity_decode($row['description'])) ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

<!-- Include Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper with Responsive Settings -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,  // Default: Show 2 slides
        spaceBetween: 30,  
        loop: true,  
        autoplay: {
            delay: 2000,  // Slower transition: 5 seconds per slide
            disableOnInteraction: false,
        },
        speed: 1200,  // Smooth transition speed
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1200: { slidesPerView: 2, spaceBetween: 30 },  // Large screens
            768: { slidesPerView: 1, spaceBetween: 20 },   // Tablets
            480: { slidesPerView: 1, spaceBetween: 15 }    // Mobile screens
        }
    });
</script>

<!-- Custom CSS for Swiper (Mobile-Friendly) -->
<style>
.swiper {
    width: 100%;
    padding: 40px 0;
}

.swiper-slide {
    display: flex;
    justify-content: center;
}

.feature-item {
    transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    opacity: 0.9;
    border-radius: 10px;
    background-color: #f9f9f9;
    padding: 20px;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .swiper {
        padding: 20px 0;
    }
    .feature-item {
        padding: 15px;
    }
    .feature-item img {
        width: 60px;
        height: 60px;
    }
    h5 {
        font-size: 16px;
    }
    p {
        font-size: 14px;
    }
}

.swiper-slide-active .feature-item {
    opacity: 1;
    transform: scale(1.05); /* Popup effect */
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}
</style>

<!-- Feature End -->



        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="section-title text-secondary" style=" font-family: 'Saira', sans-serif;margin-top: -100px;">About Us<span></span></p>
                        <h1 class="mb-5"style=" font-family: 'Saira', sans-serif;">We are a leading IT solutions provider</h1>
                        <p class="mb-4"><?php include "about.html"; ?></p>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">Web Development</p>
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">85%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">Software Development</p>
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">90%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="skill mb-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">Design & Development</p>
                                <p class="mb-2" style=" font-family: 'Saira', sans-serif;">95%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3" style=" font-family: 'Saira', sans-serif;">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="img/about.png">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Facts Start -->
        <div class="container-xxl bg-white margin-top: -300px; fact py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-certificate fa-3x text-secondary mb-3"></i>
                        <h1 class="text-black mb-2" data-toggle="counter-up">1</h1>
                        <p class="text-black mb-0" style=" font-family: 'Saira', sans-serif;">Years Experience</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-users-cog fa-3x text-secondary mb-3"></i>
                        <h1 class="text-black mb-2" data-toggle="counter-up">5</h1>
                        <p class="text-black mb-0" style=" font-family: 'Saira', sans-serif;">Team Members</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-users fa-3x text-secondary mb-3"></i>
                        <h1 class="text-black mb-2" data-toggle="counter-up">23</h1>
                        <p class="text-black mb-0" style=" font-family: 'Saira', sans-serif;">Satisfied Clients</p>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-check fa-3x text-secondary mb-3"></i>
                        <h1 class="text-black mb-2" data-toggle="counter-up">15</h1>
                        <p class="text-black mb-0" style=" font-family: 'Saira', sans-serif;">Complete Projects</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facts End -->


       

        


        <!-- Projects Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif; margin-top: -200px;" ><span></span>Our Projects<span></span></p>
                    <h1 class="text-center mb-5" style=" font-family: 'Saira', sans-serif;">Recently Completed Projects</h1>
                </div>
                <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-12 text-center">
                        <ul class="list-inline mb-5" id="portfolio-flters">
                            <li class="mx-2 active" data-filter="*" style=" font-family: 'Saira', sans-serif;">All</li>
                            <li class="mx-2" data-filter=".first" style=" font-family: 'Saira', sans-serif;">Web Design</li>
                            <li class="mx-2" data-filter=".second" style=" font-family: 'Saira', sans-serif;">Graphic Design</li>
                        </ul>
                    </div>
                </div>
                <div class="row g-4 portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/ui.png" alt="" style="width: 40px; height: 140px;">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="img/ui.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2" style="font-family: 'Saira', sens-serif;">UI / UX Design</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.3s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/wd2.png" alt="" style="width: 40px; height: 140px;">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="img/portfolio-2.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2" style=" font-family: 'Saira', sans-serif;">Web Development</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.5s">
                        <div class="rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/sd.png" alt="" style="width: 20px; height: 140px;">
                                <div class="portfolio-overlay">
                                    <a class="btn btn-square btn-outline-light mx-1" href="img/portfolio-3.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-square btn-outline-light mx-1" href=""><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="bg-light p-4">
                                <p class="text-primary fw-medium mb-2" style=" font-family: 'Saira', sans-serif;">Software Development</p>
                               
                            </div>
                        </div>
                    </div>
                  
            </div>
        </div>
        <!-- Projects End -->

       


        
        <div class="container-fluid bg-white text-light footer wow fadeIn" data-wow-delay="0.1s" style="font-family: 'Saira', sans-serif; margin-top: -10px;">
    <div class="container py-3 px-lg-5">
        <div class="row g-4">
            <!-- Address Section (Left) -->
            <div class="col-md-4">
                <p class="section-title text-black h5 mb-4">Address<span></span></p>
                <p style="color: black;"><i class="fa fa-map-marker-alt me-3"></i><?php echo $contact['address']; ?></p>
                <p style="color: black;"><i class="fab fa-whatsapp me-3" style="color: #25D366;"></i> <?php echo $contact['mobile']; ?></p>
                <p style="color: black;"><i class="fa fa-envelope me-3"></i><?php echo $contact['email']; ?></p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-black btn-social" href=""><i class="fab fa-twitter" style="color: black;"></i></a>
                    <a class="btn btn-outline-black btn-social" href="https://www.facebook.com/people/%F0%9D%90%8A%F0%9D%90%A7%F0%9D%90%A2%F0%9D%90%AD-%F0%9D%90%81%F0%9D%90%B2%F0%9D%90%AD%F0%9D%90%9E%F0%9D%90%AC/61573687555805/?name=FollowerInviteNotifRenderer"><i class="fab fa-facebook-f" style="color: black;"></i></a>
                    <a class="btn btn-outline-black btn-social" href=""><i class="fab fa-instagram" style="color: black;"></i></a>
                    <a class="btn btn-outline-black btn-social" href=""><i class="fab fa-linkedin-in" style="color: black;"></i></a>
                </div>
            </div>

            <!-- Gallery Section (Centered) -->
            <div class="col-md-4 text-center">
                <p class="section-title text-black h5 mb-4">Gallery<span></span></p>
                <div class="row g-2 justify-content-center">
                    <div class="col-4"><img class="img-fluid" src="img/android.png" alt="Image"></div>
                    <div class="col-4"><img class="img-fluid" src="img/software.png" alt="Image"></div>
                    <div class="col-4"><img class="img-fluid" src="img/web.png" alt="Image"></div>
                    <div class="col-4"><img class="img-fluid" src="img/sd.png" alt="Image"></div>
                    <div class="col-4"><img class="img-fluid" src="img/wd2.png" alt="Image"></div>
                    <div class="col-4"><img class="img-fluid" src="img/ui.png" alt="Image"></div>
                </div>
            </div>

            <!-- Quick Links (Rightmost Position with Space) -->
            <div class="col-md-3 offset-md-1 text-md-end" style="margin-left: auto;">
              
            <p class="section-title text-black h5 mb-4">Quick Link<span></span></p>
                <a class="btn btn-link" href="about.php" style="color: black; text-decoration: none;">About Us</a>
                <a class="btn btn-link" href="contact.php" style="color: black; text-decoration: none;">Contact Us</a>
                <a class="btn btn-link" href="contact.php" style="color: black; text-decoration: none;">Internship & Career</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="container px-lg-5">
        <div class="copyright" style="color: black;">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="" style="color: black;">Knit Bytes</a>, All Right Reserved. 
                  
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="index.php" style="color: black;">Home</a>
                        <a href="" style="color: black;">Cookies</a>
                        <a href="contact.php" style="color: black;">Help</a>
                        <a href="" style="color: black;">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
                    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>