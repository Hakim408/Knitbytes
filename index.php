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
    html {
  scroll-behavior: smooth;
}
    </style>
    <meta charset="utf-8">
    <title>KnitBytes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Knit Bytes offers cutting-edge IT solutions, including web development, software development, and digital solutions tailored to your business needs.">
    <meta name="keywords" content="Knit Bytes, IT Solutions, Web Development, Software Development, Digital Solutions">
    <meta name="author" content="Knit Bytes">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Knit Bytes - Leading IT Solutions Provider">
    <meta property="og:description" content="Knit Bytes offers cutting-edge IT solutions, including web development, software development, and digital solutions tailored to your business needs.">
    <meta property="og:image" content="img/banner.jpg">
    <meta property="og:url" content="https://knitbytes.com">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Knit Bytes - Leading IT Solutions Provider">
    <meta name="twitter:description" content="Knit Bytes offers cutting-edge IT solutions, including web development, software development, and digital solutions tailored to your business needs.">
    <meta name="twitter:image" content="img/banner.jpg">
     
    <link rel="canonical" href="https://knitbytes.com">


    <link href="img/lg.png" rel="icon">
    <!-- <link rel="icon" href="images/favicon.png" type="image/png"> -->
    
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
    <script>
         // Function to scroll to the relevant section based on search query
        function searchContent(event) {
            event.preventDefault(); // Prevent the default form submission

            var searchQuery = $('#search-bar').val().toLowerCase(); // Get the search query in lowercase

            // Find the relevant section based on the search query
            if (searchQuery) {
                // Scroll to the section based on the search keyword
                if (searchQuery.includes('service') || searchQuery.includes('web') || searchQuery.includes('digital') || searchQuery.includes('android') || searchQuery.includes('custom')) {
                    $('html, body').animate({
                        scrollTop: $('#services').offset().top
                    }, 500); // Smooth scroll to the services section
                } else {
                    alert('No relevant section found for your search.');
                }
            }
        }
        
    </script>
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    
    <div class="container-fluid bg-white p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow " style="width: 3rem; height: 3rem;color: #022b60;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        


        
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
            <div class="d-flex ms-3 align-items-center">
    <!-- Search Form -->
    <div class="search-container position-relative">
        <form onsubmit="searchContent(event)" class="d-flex align-items-center">
            <!-- Search Input -->
            <input type="text" class="form-control" id="search-bar" placeholder="Search for services..." 
                   style="width: 250px; padding: 10px; border-radius: 20px;"/>
            
            <!-- Search Button with background color and overlapping -->
            <button type="submit" class="btn" style="background-color: #FBA504; 
                                                    border-radius: 20px; 
                                                    padding: 10px 20px; 
                                                    color: white;
                                                    position: absolute;
                                                    right: -10px; /* Adjusts overlap */
                                                    top: 50%;
                                                    transform: translateY(-50%);">
                Search
            </button>
        </form>
    </div>
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
<div id="services" class="container-fluid py-5">
  <div class="container py-5 px-lg-5">
    <div class="text-center mb-5">
      <p class="section-title text-secondary justify-content-center" style="font-family: 'Saira', sans-serif;">
        <span></span>Our Services<span></span>
      </p>
      <h1 style="font-family: 'Saira', sans-serif;">What Solutions We Provide</h1>
    </div>

    <div class="row g-4">
      <?php 
        $e_qry = $conn->query("SELECT * FROM services ORDER BY (title = 'Web Development') DESC, title ASC");
        while($row = $e_qry->fetch_assoc()):
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="service-card h-100 text-center p-3">
            <img src="<?php echo validate_image($row['file_path']) ?>" 
                 alt="<?php echo $row['title'] ?>" 
                 class="service-img mb-3">
            <h6 class="service-title mb-0"><?php echo $row['title']; ?></h6>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<style>
/* Section background for contrast */
#services {
  background: linear-gradient(135deg, #f0f4f8 0%, #ffffff 100%);
}

/* Card container */
.service-card {
  background: #022b60;
  border-radius: 15px;
  border: none;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
  font-family: 'Saira', sans-serif;
  min-height: 300px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  transform-style: preserve-3d;
  will-change: transform;
}

/* Card hover (3D float) */
.service-card:hover {
  transform: translateY(-12px) scale(1.02);
  box-shadow: 0 20px 35px rgba(0, 0, 0, 0.4);
  background-color: #014080;
}

/* Image inside card */
.service-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid white;
  transition: transform 0.3s ease, border-color 0.3s ease;
}

/* Image hover */
.service-card:hover .service-img {
  transform: scale(1.1);
  border-color: #FBA504;
}

/* Title inside card */
.service-title {
  font-size: 1rem;
  color: #ffffff;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: color 0.3s ease;
}

/* Title hover */
.service-card:hover .service-title {
  color: #FBA504;
}

/* Responsive tweaks */
@media (max-width: 576px) {
  .service-card {
    padding: 20px 15px;
    min-height: 220px;
  }

  .service-img {
    width: 70px;
    height: 70px;
  }
}
</style>

        <div class="container-fluid py-8 pb-3">
        <div class="container py-5 px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="section-title text-secondary" style="font-family: 'Saira', sans-serif; margin-bottom: 100px;">About Us<span></span></p>
                <h1 class="mb-5" style="font-family: 'Saira', sans-serif;">We are a leading IT solutions provider</h1>
                <p class="mb-4" style="font-family: 'Saira', sans-serif;">
                <?php include "about.html"; ?>
                </p>

                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Web Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">85%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 85%;" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Software Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">90%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 90%;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="skill mb-4">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">Design & Development</p>
                        <p class="mb-2" style="font-family: 'Saira', sans-serif;">95%</p>
                    </div>
                    <div class="progress" style="height: 8px; width: 80%; margin: 0 auto;">
                        <div class="progress-bar" style="background-color: #FBA504; width: 95%;" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <a href="about.php" class="btn btn-primary py-sm-3 px-sm-5 rounded-pill mt-3" style="font-family: 'Saira', sans-serif; background-color: #022b60; border-color: #022b60; ">
                    Read More
                </a>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid wow zoomIn" data-wow-delay="0.5s" src="img/about.png" alt="About Us">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-white fact py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5 px-lg-5">
        <div class="row g-4">

            <!-- Experience -->
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <i class="fa fa-certificate fa-3x text-secondary mb-3"></i>
                <h1 class="text-black mb-2" data-toggle="counter-up">1</h1>
                <p class="text-black mb-0" style="font-family: 'Saira', sans-serif;">Years Experience</p>
            </div>

            <!-- Team Members-->
            <div class="col-md-6 col-lg-3 text-center wow fadeIn position-relative" data-wow-delay="0.3s">
                <a href="team.php" class="stretched-link" style="text-decoration: none;"></a>
                <i class="fa fa-users-cog fa-3x text-secondary mb-3"></i>
                <h1 class="text-black mb-2" data-toggle="counter-up">5</h1>
                <p class="text-black mb-0" style="font-family: 'Saira', sans-serif;">Team Members</p>
            </div>

            <!-- Clients -->
            <div class="col-md-6 col-lg-3 text-center wow fadeIn position-relative" data-wow-delay="0.5s">
             <a href="#testimonial" class="stretched-link" style="text-decoration: none;"></a>
             <i class="fa fa-users fa-3x text-secondary mb-3"></i>
             <h1 class="text-black mb-2" data-toggle="counter-up">23</h1>
             <p class="text-black mb-0" style="font-family: 'Saira', sans-serif;">Satisfied Clients</p>
            </div>


            <!-- Projects -->
            <div class="col-md-6 col-lg-3 text-center wow fadeIn position-relative" data-wow-delay="0.7s">
              <a href="#projects" class="stretched-link" style="text-decoration: none;"></a>
                <i class="fa fa-check fa-3x text-secondary mb-3"></i>
                <h1 class="text-black mb-2" data-toggle="counter-up">15</h1>
                <p class="text-black mb-0" style="font-family: 'Saira', sans-serif;">Complete Projects</p>
            </div>


        </div>
    </div>
</div>


        <div class="container-fluid py-5">
        <div class="container py-5 px-lg-5">
        <div id="projects" class="text-center mb-5">
        <p class="section-title text-secondary justify-content-center" style=" font-family: 'Saira', sans-serif;margin-top: -100px;">
                <span></span>Our Project<span></span>
            </p>
            <h1 class="fw-bold text" style="font-family: 'Saira', sans-serif;">Recently Completed Projects</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card bg-light shadow-sm border-0 rounded">
                    <div class="position-relative">
                    <img src="img/wd.png" class="img-fluid rounded-top" alt="College Website" >

                        <div class="portfolio-overlay d-flex justify-content-center align-items-center">
                            <a class="btn btn-outline-dark btn-sm mx-1" href="img/drms.jpg" data-lightbox="portfolio">
                            
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
                        <h5 class="fw-bold  " style="font-family: 'Saira', sans-serif; color: #022b60;">Sankhya Solution</h5>
                        <p class="text-muted mb-2" style="font-family: 'Saira', sans-serif;">Software Development</p>
                    </div>
                </div>
            </div>

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


       


<div id="testimonial" class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-bottom: 100px;">
    <div class="container py-5 px-lg-5">
        <p class="section-title text-secondary justify-content-center" style="font-family: 'Saira', sans-serif;"><span></span>Testimonial<span></span></p>
        <h1  class="text-center mb-5" style="font-family: 'Saira', sans-serif;">What Our Clients Say!</h1>
        <div class="owl-carousel testimonial-carousel">
            <?php 
                $qry = $conn->query("SELECT * FROM testimonials ORDER BY RAND()");
                while($row = $qry->fetch_assoc()):
                    $row['message'] = html_entity_decode($row['message']);
                    $row['message'] = str_replace('Knit Bytes', '<a href="https://knitbytes.com" target="_blank">Knit Bytes</a>', $row['message']);
            ?>
            <div class="testimonial-item bg-light rounded my-4">
                <p class="fs-5 d-flex justify-content-left align-items-center" style="font-family: 'Saira', sans-serif;">
                    <i class="fa fa-quote-left fa-2x text-secondary me-2"></i> 
                    <?php echo $row['message']; ?>
                  
                </p>
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded-circle" 
                         src="<?php echo validate_image($row['file_path']); ?>" 
                         alt="<?php echo $row['message_from']; ?>" 
                         style="width: 65px; height: 65px;">

                    <div class="ps-4">
                        <h5 class="mb-1" style="font-family: 'Saira', sans-serif;"><?php echo $row['message_from']; ?></h5>
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
        items: 1,  
        loop: true,  
        autoplay: true,  
        autoplayTimeout: 3000, 
        autoplayHoverPause: true,  
        autoplaySpeed: 1000,  
        nav: false,  
        dots: true  
    });
});
</script>

<style>
    
.section-title, h1 {
    font-family: 'Saira', sans-serif;
}

.testimonial-carousel {
    position: relative;
}

.testimonial-item p {
    font-family: 'Saira', sans-serif; 
}

.testimonial-item h5 {
    font-family: 'Saira', sans-serif; 
}

.testimonial-item span {
    font-family: 'Saira', sans-serif; 
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
</>


<div id="chatBubble" class="chat-bubble">
    <button id="chatButton" class="btn btn-primary rounded-circle">
        <i class="bi bi-chat-dots"></i> 
    </button>
</div>

<div id="chatboxContainer" class="chatbox-container">
    <div id="chatboxHeader">
        <h4>Chat with us!</h4>
        <button id="closeChat" class="btn-close">&times;</button>
    </div>
    <div id="chatbox">
        <div class="bot-message">Hello! How can I assist you today?</div>
    </div>
    <div id="chatInputArea">
        <input type="text" id="userMessage" placeholder="Type your message..." />
        <button id="sendButton" class="btn btn-primary">Send</button>
    </div>
</div>

<script>
    
    document.getElementById('sendButton').addEventListener('click', function() {
        var userMessage = document.getElementById('userMessage').value.trim();

        if (userMessage) {
            var encodedMessage = encodeURIComponent(userMessage);
            var whatsappLink = 'https://wa.me/9779767981534?text=' + encodedMessage;
            console.log('Redirecting to WhatsApp with link: ' + whatsappLink); 
            window.location.href = whatsappLink;
            document.getElementById('chatboxContainer').style.display = 'none';
        } else {
            alert('Please type a message before sending.');
        }
    });
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom CSS -->
<style>
    /* Chat Bubble (hidden initially) */
    /* Chat Bubble (hidden initially) */
.chat-bubble {
    position: fixed;
    bottom: 100px;  /* Adjusted to avoid overlapping */
    right: 42px;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: pulse 1.5s infinite;  /* Pulsing effect */
}

/* Pulse Animation */
@keyframes pulse {
    0% {
        transform: scale(1);  /* Normal size */
    }
    50% {
        transform: scale(1.1);  /* Slightly bigger */
    }
    100% {
        transform: scale(1);  /* Back to normal size */
    }
}

.chat-bubble .btn {
    padding: 12px;  /* Reduced padding to fit the circular shape */
    border-radius: 50%;  /* Ensures the button is circular */
    font-size: 24px;
    background-color: #007bff; /* Blue background */
    color: white; /* Icon color */
    box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5); /* Glow effect */
    width: 60px; /* Fixed width */
    height: 60px; /* Fixed height to make it perfectly circular */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Hover effect for the icon */
.chat-bubble .btn:hover {
    background-color: #0056b3; /* Darker blue when hovered */
    box-shadow: 0px 0px 15px rgba(0, 123, 255, 0.8); /* Stronger glow */
}

    /* Chat Bubble Button Styling */
    #chatButton {
        padding: 15px;
        border-radius: 50%;
        font-size: 24px;
        background-color:rgb(14, 201, 92);
        color: white;
        border: none;
        cursor: pointer;
    }

    /* Chatbox Styling */
    .chatbox-container {
        position: fixed;
        bottom: 95px;  /* Just above footer */
        right: 30px;
        width: 350px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        display: none; /* Initially hidden */
        flex-direction: column;
        z-index: 9999;
    }

    /* Header of the chatbox */
    #chatboxHeader {
        padding: 10px;
        background-color: #022b60;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    #chatboxHeader h4 {
    color: white; /* Ensure the header text is white */
}


    /* Chat Area */
    #chatbox {
        padding: 10px;
        height: 300px;
        overflow-y: auto;
        background-color:rgb(229, 235, 227);
    }

    /* Message Styles */
    .bot-message, .user-message {
        margin: 10px 0;
        padding: 10px;
        border-radius: 10px;
    }

    .bot-message {
        background-color:rgb(13, 212, 73);
        text-align: left;
        color: white;
    }

    .user-message {
        background-color: #c3e6cb;
        text-align: right;
    }

    /* Input Area */
    #chatInputArea {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #ddd;
    }

    #chatInputArea input {
        width: 80%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #chatInputArea button {
        padding: 10px;
        margin-left: 10px;
        border: none;
        background-color: #022b60;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    #chatInputArea button:hover {
        background-color: #0056b3;
    }

    /* Close Button */
    #closeChat {
        background: none;
        border: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }
</style>

<!-- Custom JavaScript -->
<script>
   document.getElementById("chatButton").addEventListener("click", function() {
    var chatbox = document.getElementById("chatboxContainer");
    chatbox.style.display = (chatbox.style.display === "none" || chatbox.style.display === "") ? "flex" : "none";
});

document.getElementById("closeChat").addEventListener("click", function() {
    var chatbox = document.getElementById("chatboxContainer");
    chatbox.style.display = "none";
});

document.getElementById("sendButton").addEventListener("click", function() {
    sendMessage();
});

document.getElementById("userMessage").addEventListener("keydown", function(event) {
    if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();  // Prevent new line from being inserted
        sendMessage();
    }
});

function sendMessage() {
    var userMessage = document.getElementById("userMessage").value.trim();
    if (userMessage !== "") {
        addMessage(userMessage, "user-message");
        generateBotResponse(userMessage);
        document.getElementById("userMessage").value = "";  // Clear input
    }
}

function addMessage(message, sender) {
    var messageDiv = document.createElement("div");
    messageDiv.classList.add(sender);
    messageDiv.textContent = message;
    document.getElementById("chatbox").appendChild(messageDiv);
    scrollToBottom();
}

function generateBotResponse(userMessage) {
    addMessage("Typing...", "bot-message"); 

    fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: userMessage })
    })
    .then(response => response.json())
    .then(data => {
        document.querySelector(".bot-message:last-child").remove(); 
        addMessage(data.response, "bot-message"); 
    })
    .catch(error => {
        document.querySelector(".bot-message:last-child").remove();
        addMessage("Sorry, there was an error.", "bot-message");
        console.error("Error:", error);
    });
}


function scrollToBottom() {
    var chatbox = document.getElementById("chatbox");
    chatbox.scrollTop = chatbox.scrollHeight;
}

</script>

        
        <div class="container-fluid bg-white text-light footer wow fadeIn" data-wow-delay="0.1s" style="font-family: 'Saira', sans-serif; margin-top: -60px;">
        <div class="container-fluid py-3 px-lg-5">
        <div class="row g-4">
            
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


<style>
    .col-4 {
    padding: 5px;
    transition: background-color 0.3s ease;
    border-radius: 8px;
            }

    .col-4:hover {
                     background-color: #022b60;
                 }
    .col-4 img {
        height: 100px;
        object-fit: cover; 
        border-radius: 8px;  
        border: 1px solid #ccc;  
                }
</style>

            <div class="col-md-3 offset-md-1 text-md-end" style="margin-left: auto;">
            <p class="section-title text-black h5 mb-4">Quick Link<span></span></p>
                <a class="btn btn-link" href="about.php" style="color: black; text-decoration: none;">About Us</a>
                <a class="btn btn-link" href="contactus.php" style="color: black; text-decoration: none;">Contact Us</a>
                <a class="btn btn-link" href="contact.php" style="color: black; text-decoration: none;">Internship & Career</a>
            </div>
            </div>
        </div>
    </div>

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

        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
     <!-- Vacancy Modal -->

<div class="modal fade" id="vacancyModal" tabindex="-1" aria-labelledby="vacancyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content vacancy-animated" style="font-family: 'Saira', sans-serif;">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="vacancyModalLabel" style="font-weight: 600;">
          📢 Job Vacancy Open
        </h5>
        <button type="button" class="custom-close" data-bs-dismiss="modal" aria-label="Close" title="Cancel">&times;</button>
      </div>
      <div class="modal-body text-dark" style="line-height: 1.7;">
        <p>
          We are currently looking for passionate and skilled individuals to join our team. 
          If you're interested in networking field such as Network Administrator,Security Analyst,Network Analyst, please send your resume or inquiries to:
        </p>
        <p style="font-weight: bold; color: #022b60;">
          📧 <a href="mailto:info@knitbytes.com" style="text-decoration: none; color: #022b60;">info@knitbytes.com</a>
        </p>
        <p style="font-size: 0.9rem; color: #666;">
          * Please include the position you are applying for in the subject line.
        </p>
      </div>
    </div>
  </div>
</div>

<style>
  .vacancy-animated {
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    animation: bounceIn 0.7s ease-out;
    background: #fff;
    transition: transform 0.3s ease-in-out;
  }

  .vacancy-animated:hover {
    transform: scale(1.02);
  }

  @keyframes bounceIn {
    0% {
      opacity: 0;
      transform: scale(0.95) translateY(-20px);
    }
    60% {
      opacity: 1;
      transform: scale(1.05) translateY(10px);
    }
    100% {
      transform: scale(1) translateY(0);
    }
  }

  .custom-close {
    font-size: 1.5rem;
    color: #022b60;
    background: none;
    border: none;
    cursor: pointer;
    margin-top: -10px;
    margin-right: -10px;
  }

  .modal-content a:hover {
    text-decoration: underline;
  }
</style>



<script>
  window.addEventListener('load', function() {
    var vacancyModal = new bootstrap.Modal(document.getElementById('vacancyModal'));
    vacancyModal.show();
  });
</script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
                    
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>