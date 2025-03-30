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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0 container-fluid">
            <a href="index.php" class="navbar-brand p-0">
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
                    </div> <a href="contact.php" class="btn rounded-pill py-2 px-4 ms-3" style="background-color: #FBA504">Apply For Internship</a> 
                </div>
            </nav>
            <?php 
$u_qry = $conn->query("SELECT * FROM users where id = 1");
foreach($u_qry->fetch_array() as $k => $v){
  if(!is_numeric($k)){
    $user[$k] = $v;
  }
}
$c_qry = $conn->query("SELECT * FROM contacts");
while($row = $c_qry->fetch_assoc()){
    $contact[$row['meta_field']] = $row['meta_value'];
}
// var_dump($contact['facebook']);
?>
      
        <!-- Navbar & Hero End -->


  <!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container py-5 px-lg-5">
    <div class="container py-3 px-lg-5">
        <!-- Display Success/Error Message -->
        <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); 
            }

            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            }
        ?>

    <div class="container d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 20vh; margin-top: 80px;">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <p class="section-title text-secondary" style="font-family: 'Saira', sans-serif; font-weight: bold; padding-bottom: 5px;">
                <span></span>Contact Us<span></span>
            </p>
            <h3 class="apply-text">Apply for Internship</h3>
            <!-- <style>
.apply-text {
    font-family: 'Saira', sans-serif;
    font-weight: bold;
    font-size: 24px;
    color: #ffffff;
    background: linear-gradient(45deg, #ff8a00, #e52e71, #007bff, #00c851);
    background-size: 400% 400%;
    padding: 10px 20px;
    border-radius: 10px;
    display: inline-block;
    text-align: center;
    animation: popUp 0.8s ease-out, gradientBG 4s infinite linear;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

@keyframes popUp {
    0% {
        transform: translateY(10px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}
</style> -->

        </div>
    </div>
</div>



        <div class="row justify-content-center">
            <!-- Left Side - Contact Info -->
            <div class="col-lg-5 wow animate__animated animate__fadeInLeft" data-wow-delay="0.3s">
    <div class="contact-info p-4 shadow-sm" style="background: linear-gradient(135deg, #022b60, #022b60); color: white; border-radius: 10px; font-family: 'Saira', sans-serif; margin-top: 250px;">
        <h4 class="mb-4" style="color: #FBA504; font-weight: bold;">Get In Touch</h4>
        <p style="color: white; font-size: 16px; line-height: 1.5; margin: 0;">
            <i class="fa fa-map-marker-alt me-3" style="color:rgb(22, 130, 253);"></i>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($contact['address']); ?>" 
               target="_blank" 
               style="color: white; text-decoration: none; font-weight: 500; transition: color 0.3s ease-in-out;">
               <?php echo $contact['address']; ?>
            </a>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($contact['address']); ?>" 
               target="_blank" 
               style="font-size: 14px; color: rgb(22, 130, 253); margin-left: 250px; font-style: italic; text-decoration: none;">
                (View on Map)
            </a>
        </p>

        <p style="color: white;">
            <i class="fab fa-whatsapp me-3" style="color: #25D366;"></i> 
            <?php echo $contact['mobile']; ?>
        </p>
        <p style="color: white;">
            <i class="fa fa-envelope me-3"></i>
            <?php echo $contact['email']; ?>
        </p>
    </div>
</div>



            <!-- Right Side - Internship Application Form -->
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
            <div class="contact-info p-4 shadow-sm" style="background: linear-gradient(135deg, #022b60, #022b60); color: white; border-radius: 10px;">
            <h3 class="apply-now-text">Apply Now</h3>
            <form id="internshipForm" action="send_email.php" method="POST" enctype="multipart/form-data">
                    <!-- Full Name Field -->
                    <div class="form-group mb-3 ">
                        <label for="full_name"  class="text-black" >Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    
                    <!-- Email Address Field -->
                    <div class="form-group mb-3">
                        <label for="email" class="text-black">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <!-- Phone Number Field -->
                    <div class="form-group mb-3">
                        <label for="phone_number" class="text-black">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>

                    <!-- College Name Field -->
                    <div class="form-group mb-3">
                        <label for="college_name" class="text-black">College Name</label>
                        <input type="text" class="form-control" id="college_name" name="college_name" required>
                    </div>

                    <!-- Degree/Program Field -->
                    <div class="form-group mb-3">
                        <label for="degree" class="text-black">Degree/Program</label>
                        <input type="text" class="form-control" id="degree" name="degree" required>
                    </div>

                    <!-- Upload Resume Field -->
                    <div class="form-group mb-3">
                        <label for="resume" class="text-black">Upload Resume</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                    </div>

                    <!-- Skills Field -->
                    <div class="form-group mb-3">
                        <label for="skills" class="text-black">Skills</label>
                        <textarea class="form-control" id="skills" name="skills" required rows="3"></textarea>
                    </div>

                    <!-- Faculty Dropdown -->
                    <div class="form-group mb-3">
                        <label for="faculty" class="text-black">Faculty</label>
                        <select class="form-control" id="faculty" name="faculty" required>
                            <option value="" disabled selected>Select Faculty</option>
                            <option value="BCA">BCA</option>
                            <option value="BSc.CSIT">BSc. CSIT</option>
                            <option value="BIT">BIT</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <!-- Semester Dropdown -->
                    <div class="form-group mb-3">
                        <label for="semester" class="text-black">Semester</label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option value="" disabled selected>Select Semester</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                            <option value="3rd">3rd Semester</option>
                            <option value="4th">4th Semester</option>
                            <option value="5th">5th Semester</option>
                            <option value="6th">6th Semester</option>
                            <option value="7th">7th Semester</option>
                            <option value="8th">8th Semester</option>
                        </select>
                    </div>

                    <!-- Apply For Field -->
                    <div class="form-group mb-3">
                        <label for="apply_for" class="text-black">Internship Position Applied For</label>
                        <input type="text" class="form-control" id="apply_for" name="apply_for" required placeholder="E.g., Frontend Developer, Backend Developer, Marketing Intern">
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="font-family: 'Saira', sans-serif; font-weight: bold; padding: 10px 30px;">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Additional CSS to Style the Form Attractively -->
<style>
    .apply-now-text {
    text-align: center; /* Centers the text horizontally */
    font-size: 28px; /* Adjust the font size */
    font-family: 'Saira', sans-serif;
    font-weight: bold;
    color: #FBA504; /* White color for text */
    margin-bottom: 20px; /* Add space below the text */
}

    @keyframes slideInLeft {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.contact-info {
    background: linear-gradient(135deg, #022b60, #022b60);
    color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: slideInLeft 1s ease-in-out;
}

.contact-info h4 {
    font-family: 'Saira', sans-serif;
    font-weight: bold;
}

.contact-info p {
    color: black;
    font-size: 16px;
}

.contact-info i {
    font-size: 18px;
}

.form-control {
    width: 80%;
    margin: 0 auto 15px auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 8px 12px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 8px rgba(0, 0, 255, 0.6);
    border-color: #2575fc;
}

.btn-primary {
    background: linear-gradient(135deg,rgb(149, 181, 224),rgb(134, 169, 214));
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    padding: 10px 25px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
}

</style>


<!-- Contact End -->

        <!-- Contact End -->
        

        <div class="container-fluid bg-white text-light footer wow fadeIn" data-wow-delay="0.1s" style="font-family: 'Saira', sans-serif; margin-top: -10px;">
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
</body>

</html>