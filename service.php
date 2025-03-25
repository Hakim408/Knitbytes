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

<head>
    <meta charset="utf-8">
    <title>Knit Bytes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/lg.png" rel="icon">

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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
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
                    <a href="contact.php" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block" style="background-color:  #FBA504">Apply For Internship</a>
                </div>
            </nav>
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
  
         


        <!-- Service Start -->
        <div class="container-xxl py-5">
    <div class="container py-5 px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif; margin-top: 80px;">
                <span></span>Our Services<span></span>
            </p>
            <h1 class="text-center mb-5" style=" font-family: 'Saira', sans-serif;color: #022b60;">What Solutions We Provide</h1>
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
            delay: 5000,  // Slower transition: 5 seconds per slide
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
        <!-- Service End -->


      


            
        

        <!-- Footer Start -->
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>