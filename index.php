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
<style>
@media (max-width: 767px) {
    .swiper-slide .service-description {
        display: none !important;
    }
}





    </style>
    <meta charset="utf-8">
    <title>KnitBytes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/lg.png" rel="icon">
    <!-- <link rel="icon" href="images/favicon.png" type="image/png"> -->
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
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow " style="width: 3rem; height: 3rem;color: #022b60;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0 container-fluid" style="min-height: 100px;">
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
                <a href="contactus.php" class="nav-item nav-link">Contact</a>
            </div>
            <a href="contact.php" class="btn rounded-pill py-2 px-4 ms-3" style="background-color: #FBA504">Apply For Internship</a>

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
<div class="container-fluid bg-light hero-header pb-5 ">
    <div class="container px-lg-6">
        <div class="row g-5 align-items-center">
        <div class="col-lg-6 text-center text-lg-start" style=" font-family: 'Saira', sans-serif;">
    <h1 class="text-black pb-3 animated slideInDown" style=" font-family: 'Saira', sans-serif;">
        <?php echo $_settings->info('name') ?>
    </h1>
    <p class="text-black pb-3 animated slideInDown" style="text-align: justify;" style=" font-family: 'Saira', sans-serif;">
        <?php echo stripslashes($_settings->info('welcome_message')) ?>
    </p>
    <a href="service.php" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft" style="font-family: 'Saira', sans-serif; background-color: #022b60; border-color: #022b60;">
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
<div class="container-fluid py-5">
    <div class="container-fluid py-5 px-lg-5">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif;margin-top: -5px;">
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
                             style="width: 300px; height: 200px;">
                        
                             <h5 class="mb-3" style="font-family: 'Saira', sans-serif;"><?php echo $row['title']; ?></h5>

                        

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


.swiper-slide-active .feature-item {
    opacity: 1;
    transform: scale(1.05); /* Popup effect */
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}
</style>


<!-- Feature End -->



        <!-- About Start -->
        <div class="container-fluid py-8 pb-3">
    <div class="container py-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="section-title text-secondary" style="font-family: 'Saira', sans-serif; margin-bottom: 100px;">About Us<span></span></p>
                <h1 class="mb-5" style="font-family: 'Saira', sans-serif;">We are a leading IT solutions provider</h1>
                <p class="mb-4"><?php include "about.html"; ?></p>

                <!-- Skill 1: Web Development -->
                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Web Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">85%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 85%;" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Skill 2: Software Development -->
                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Software Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">90%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 90%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Skill 3: Design & Development -->
                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Design & Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">95%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 95%;" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Read More Button -->
                <a href="about.php" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3" style="font-family: 'Saira', sans-serif; background-color: #022b60; border-color: #022b60; ">
                    Read More
                </a>
            </div>

            <!-- Image Section -->
            <div class="col-lg-6">
                <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="img/about.png" alt="About Us">
            </div>
        </div>
    </div>
</div>

        <!-- About End -->


        <!-- Facts Start -->
        <div class="container-fluid bg-white margin-top: -300px; fact py-5 wow fadeInUp" data-wow-delay="0.1s">
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


       

        


        <div class="container-fluid py-5">
    <div class="container py-5 px-lg-5">
        <div class="text-center mb-5">
        <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif;margin-top: -100px;">
                <span></span>Our Project<span></span>
            </p>
            <h1 class="fw-bold text" style="font-family: 'Saira', sans-serif;">Recently Completed Projects</h1>
        </div>
        
        <div class="row g-4">
            <!-- Project 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card bg-light shadow-sm border-0 rounded">
                    <div class="position-relative">
                    <img src="img/wd.png" class="img-fluid rounded-top" alt="College Website" >

                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <a class="btn btn-outline-dark btn-sm mx-1" href="img/drms1.PNG" data-lightbox="portfolio">
                            
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-sm mx-1" href="https://drms.edu.np/">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                    <h5 class="fw-bold" style="font-family: 'Saira', sans-serif; color: #022b60;">School Website</h5>

                        <p class="text-muted mb-2" style="font-family: 'Saira', sans-serif;">Web Development</p>
                    </div>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card bg-light shadow-sm border-0 rounded">
                    <div class="position-relative">
                        <img src="img/wd.png" class="img-fluid rounded-top" alt="Shankhya Solution">
                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <a class="btn btn-outline-dark btn-sm mx-1" href="img/drms2.PNG" data-lightbox="portfolio">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-sm mx-1" href="#">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold  " style="font-family: 'Saira', sans-serif; color: #022b60;">Shankhya Solution</h5>
                        <p class="text-muted mb-2" style="font-family: 'Saira', sans-serif;">Software Development</p>
                    </div>
                </div>
            </div>

            <!-- Project 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card bg-light shadow-sm border-0 rounded">
                    <div class="position-relative">
                        <img src="img/wd.png" class="img-fluid rounded-top" alt="Sahakari E-commerce">
                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <a class="btn btn-outline-dark btn-sm mx-1" href="img/drms2.PNG" data-lightbox="portfolio">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-sm mx-1" href="#">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold " style="font-family: 'Saira', sans-serif; color: #022b60;">Sahakari E-commerce</h5>
                        <p class="text-muted mb-2" style="font-family: 'Saira', sans-serif;">E-Commerce Platform</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


       


<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-bottom: 100px;">
    <div class="container py-5 px-lg-5">
        <p class="section-title text-secondary justify-content-center"><span></span>Testimonial<span></span></p>
        <h1 class="text-center mb-5">What Our Clients Say!</h1>
        <div class="owl-carousel testimonial-carousel">
            <?php 
                // Fetch testimonials from the database
                $qry = $conn->query("SELECT * FROM testimonials ORDER BY RAND()");
                while($row = $qry->fetch_assoc()):
                    $row['message'] = html_entity_decode($row['message']);
            ?>
            <div class="testimonial-item bg-light rounded my-4">
                <p class="fs-5 d-flex justify-content-left align-items-center">
                    <i class="fa fa-quote-left fa-2x text-secondary me-2"></i> <!-- Left quote icon -->
                    <?php echo $row['message']; ?>
                  
                </p>
                <div class="d-flex align-items-center">
                    <!-- Dynamically fetching the image -->
                    <img class="img-fluid flex-shrink-0 rounded-circle" 
                         src="<?php echo validate_image($row['file_path']); ?>" 
                         alt="<?php echo $row['message_from']; ?>" 
                         style="width: 65px; height: 65px;">

                    <div class="ps-4">
                        <h5 class="mb-1"><?php echo $row['message_from']; ?></h5>
                        <span><?php echo isset($row['profession']) ? $row['profession'] : 'Client'; ?></span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<!-- Include Owl Carousel CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Initialize Owl Carousel -->
<script>
$(document).ready(function(){
    $(".testimonial-carousel").owlCarousel({
        items: 1,  // Show one item at a time
        loop: true,  // Enable looping
        autoplay: true,  // Enable autoplay
        autoplayTimeout: 3000,  // Time between slides (5 seconds)
        autoplayHoverPause: true,  // Pause on hover
        autoplaySpeed: 1000,  // Transition speed (1 second)
        nav: false,  // Disable default navigation
        dots: true  // Enable dots navigation
    });
});
</script>

<style>
    
    

    /* Apply 'Saira' font to section-title and h1 */
.section-title, h1 {
    font-family: 'Saira', sans-serif;
}

    /* Testimonial Carousel Section */
.testimonial-carousel {
    position: relative;
}
/* Apply Saira font to testimonial content */
.testimonial-item p {
    font-family: 'Saira', sans-serif; /* Apply font to the message text */
}

.testimonial-item h5 {
    font-family: 'Saira', sans-serif; /* Apply font to the message author */
}

.testimonial-item span {
    font-family: 'Saira', sans-serif; /* Apply font to the profession */
}

.testimonial-item {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.testimonial-content p {
    font-style: italic;
    color: #555;
}

.testimonial-content h5 {
    margin-top: 15px;
    font-weight: bold;
    color: #333;
}
</style>





        
        <div class="container-fluid bg-white text-light footer wow fadeIn" data-wow-delay="0.1s" style="font-family: 'Saira', sans-serif; margin-top: -60px;">
    <div class="container-fluid py-3 px-lg-5">
        <div class="row g-4">
            <!-- Address Section (Left) -->
            <div class="col-md-4">
                <p class="section-title text-black h5 mb-4">Address<span></span></p>
                <p style= "color:rgb(22, 130, 253);">
            <i class="fa fa-map-marker-alt me-3"></i>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($contact['address']); ?>" 
               target="_blank" 
               style="color: black; text-decoration: none;">
               <?php echo $contact['address']; ?>
            </a>
        </p>
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
        <div class="col-4">
            <img class="img-fluid" src="img/android.png" alt="Image">
        </div>
        <div class="col-4">
            <img class="img-fluid" src="img/software.png" alt="Image">
        </div>
        <div class="col-4">
            <img class="img-fluid" src="img/web.png" alt="Image">
        </div>
        <div class="col-4">
            <img class="img-fluid" src="img/sd.png" alt="Image">
        </div>
        <div class="col-4">
            <img class="img-fluid" src="img/wd2.png" alt="Image">
        </div>
        <div class="col-4">
            <img class="img-fluid" src="img/ui.png" alt="Image">
        </div>
    </div>
</div>

<!-- Add this CSS to your styles -->
<style>
    /* Ensure all images have the same height while maintaining aspect ratio */
    .col-4 img {
        height: 100px;
        width: 100px /* Set a constant height for all images */
        object-fit: cover; /* Ensures the image covers the container without distorting */
        border-radius: 8px;  /* Thin rounded corners */
        border: 1px solid #ccc;  /* Optional: Thin border */
    }
</style>



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