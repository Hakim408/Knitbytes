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
    <style>
        .team-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .team-item {
            width: 320px;
            background: linear-gradient(135deg, #022b60, #022b60);
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .team-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Icons Instead of Images */
        .team-icon {
            font-size: 60px;
            color: white;
            margin-bottom: 15px;
        }

        /* Initials Instead of Images */
        .team-initials {
            width: 80px;
            height: 80px;
            background-color: white;
            color: #007bff;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: auto;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .team-name {
            font-size: 20px;
            font-weight: bold;
        }

        .team-role {
            font-size: 16px;
            font-style: italic;
            opacity: 0.9;
        }

        /* Social Media Icons */
        .social-icons {
            margin-top: 15px;
        }

        .social-icons a {
            color: white;
            font-size: 18px;
            margin: 0 8px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #ffd700;
        }

        /* Scroll Effect */
        .hidden {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s, transform 0.6s;
        }

        .visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0 container-fluid" >
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
     <!-- Team Section -->
<style>
  .team-container {
    max-width: 1200px;
    margin: auto;
    padding: 60px 20px;
    font-family: 'Saira', sans-serif;
  }

  .team-container h1 {
    text-align: center;
    color: #022b60;
    font-size: 36px;
    margin-bottom: 40px;
  }

  .team-row-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 2rem;
  }

  .team-card {
    background: linear-gradient(145deg, #0f3c64, #072448);
    color: #ffffff;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
  }

  .avatar {
    background-color: #fff;
    color: #0f3c64;
    width: 70px;
    height: 70px;
    font-weight: bold;
    font-size: 22px;
    border-radius: 50%;
    line-height: 70px;
    margin: 0 auto 15px auto;
  }

  .team-card h3 {
    margin: 10px 0 5px;
    font-size: 20px;
    color: white;
  }

  .role {
    font-style: italic;
    font-size: 14px;
    color: #d1d1d1;
  }

  .socials {
    margin-top: 15px;
  }

  .socials a {
    color: #fff;
    margin: 0 8px;
    font-size: 18px;
    transition: color 0.3s ease;
  }

  .socials a:hover {
    color: #1da1f2;
  }
  .team-card {
  color: white;
}

.team-card .socials a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border: 1px solid white;
  border-radius: 6px; /* Rounded edge rectangle */
  margin: 0 5px;
  text-decoration: none;
  color: white;
  transition: background-color 0.3s, color 0.3s, border-color 0.3s;
}

/* Facebook */
.team-card .socials a:nth-child(1):hover {
  background-color: #1877F2;
  border-color: #1877F2;
}
.team-card .socials a:nth-child(1):hover .fa-facebook-f {
  color: white;
}

/* Twitter */
.team-card .socials a:nth-child(2):hover {
  background-color: #1DA1F2;
  border-color: #1DA1F2;
}
.team-card .socials a:nth-child(2):hover .fa-twitter {
  color: white;
}

/* Instagram */
.team-card .socials a:nth-child(3):hover {
  background-color: #E1306C;
  border-color: #E1306C;
}
.team-card .socials a:nth-child(3):hover .fa-instagram {
  color: white;
}

/* LinkedIn */
.team-card .socials a:nth-child(4):hover {
  background-color: #0077B5;
  border-color: #0077B5;
}
.team-card .socials a:nth-child(4):hover .fa-linkedin-in {
  color: white;
}

.team-flip-card {
  width: 100%;
  perspective: 1000px;
}

.team-flip-inner {
  position: relative;
  width: 100%;
  height: 300px;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}

.team-flip-card:hover .team-flip-inner {
  transform: rotateY(180deg);
}

.team-flip-front,
.team-flip-back {
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: linear-gradient(145deg, #0f3c64, #072448);
  padding: 20px;
  color: white;
}

.team-flip-front .avatar {
  background-color: #fff;
  color: #0f3c64;
  width: 70px;
  height: 70px;
  font-weight: bold;
  font-size: 22px;
  border-radius: 50%;
  line-height: 70px;
  margin-bottom: 10px;
}

.team-flip-front h3 {
  font-size: 20px;
  margin: 0;
  color:white;
}

.team-flip-front .role {
  font-size: 14px;
  font-style: italic;
  color: #ccc;
}

.team-flip-back {
  transform: rotateY(180deg);
  background: #022b60;
  padding: 0;
  overflow: hidden;
  position: relative;
}

.team-flip-back img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px;
}

.linkedin-icon {
  position: absolute;
  bottom: 12px;
  right: 12px;
  background-color: #0077B5;
  width: 40px;
  height: 40px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 18px;
  transition: background 0.3s;
  text-decoration: none;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
}

.linkedin-icon:hover {
  background-color: #005582;
}


</style>

<div class="container">
    <div class="wow fadeInUp" data-wow-delay="0.1s"  >
    <p class="section-title text-secondary" style="    min-height: 300px
    ;
    margin-top: 0rem;
    margin-bottom: -1rem;
     padding-bottom: 5px;">
            <span></span>Our Team<span></span>
        </p>
        <h1 class="text-center mb-5" style="font-family: 'Saira', sans-serif; padding-top: 0px; color: #022b60;">
            Our Team Members
        </h1>
    </div>
  <div class="team-row-modern">

  <div class="team-flip-card">
  <div class="team-flip-inner">
  
    <div class="team-flip-front">
      <div class="avatar">RD</div>
      <h3>Roshan Dhakal</h3>
      <p class="role">CTO</p>
    </div>

    <div class="team-flip-back">
      <img src="img/team.png" alt="Roshan Dhakal">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>


<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
      <div class="avatar">SK</div>
      <h3>Suman Khadka</h3>
      <p class="role">Team Lead</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="Suman Khadka">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>

<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
      <div class="avatar">BB</div>
      <h3>Bikash Bhatt Chettri</h3>
      <p class="role">Co-Founder/Business Lead</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="bikash Bhatt Chettri">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>



<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
    <div class="avatar"><i class="fas fa-user-tie"></i></div>
      <h3>Niraj Gautam</h3>
      <p class="role">Full Stack Developer</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="Niraj Gautam">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>
  
<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
    <div class="avatar"><i class="fas fa-user-tie"></i></div>
      <h3>Hakim Raut</h3>
      <p class="role">Full Stack Developer</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/hakim.jpg" alt="Hakim Raut">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>


<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
    <div class="avatar"><i class="fas fa-user-tie"></i></div>
      <h3>Sulav Khadka</h3>
      <p class="role">Front End Designer (Intern)</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="Sulav Khadka">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>

<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
    <div class="avatar"><i class="fas fa-user-tie"></i></div>
      <h3>Milan Sunar</h3>
      <p class="role">Digital Marketing (Intern)</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="Milan Sunar">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>

<div class="team-flip-card">
  <div class="team-flip-inner">
    <!-- Front side -->
    <div class="team-flip-front">
    <div class="avatar"><i class="fas fa-user-tie"></i></div>
      <h3>Ashish Khadka</h3>
      <p class="role">Backend Developer (Intern)</p>
    </div>

    <!-- Back side -->
    <div class="team-flip-back">
      <img src="img/team.png" alt="Ashish Khadka">
      <a href="https://www.linkedin.com/in/yourprofile" class="linkedin-icon" target="_blank">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
  </div>
</div>

  </div>
</div>

<!-- Include FontAwesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Team End -->
        

        <div class="container-fluid bg-white text-light footer wow fadeIn" data-wow-delay="0.1s" style="font-family: 'Saira', sans-serif; margin-top: 50px;">
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
                <a class="btn btn-link" href="contactus.php" style="color: black; text-decoration: none;">Contact Us</a>
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
    <script>
        function revealOnScroll() {
            var elements = document.querySelectorAll(".hidden");
            elements.forEach((element) => {
                var position = element.getBoundingClientRect().top;
                var screenHeight = window.innerHeight;

                if (position < screenHeight - 100) {
                    element.classList.add("visible");
                }
            });
        }

        window.addEventListener("scroll", revealOnScroll);
        revealOnScroll();
    </script>
</body>

</html>