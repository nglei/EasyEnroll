<?php
session_start();
$_SESSION['servername'] = "localhost";
$_SESSION['username'] = "root";
$_SESSION['password'] = "";
$conn = new mysqli($_SESSION['servername'], $_SESSION['username'],$_SESSION['password']);
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

$createDb = "CREATE DATABASE easyenroll";
$useDb = "USE easyenroll";
$conn->query($createDb);
$conn->query($useDb);
$checkPass ="";
$errorMessage="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];
    $userType = $_POST['userType'];

    if($userType == "applicant"){
	$getUser = "SELECT username from applicant where username = '".$loginUsername."'";
    $checkPassword = "SELECT username,password from user where username='".$loginUsername."' and password = '".$loginPassword."'";
    $result = $conn->query($getUser);
	$checkPass = $conn->query($checkPassword);
  }else if($userType == "uniadmin"){
	$getUser = "SELECT adminUsername from university where adminUsername = '".$loginUsername."'";
	$result = $conn->query($getUser);
	$checkPassword = "SELECT username,password from user where username='".$loginUsername."' and password = '".$loginPassword."'";
	$checkPass = $conn->query($checkPassword);

  }else{
	$getUser = "SELECT username from sasadmin where username = '".$loginUsername."'";
    $checkPassword = "SELECT username,password from sasadmin where username='".$loginUsername."' and password = '".$loginPassword."'";
    $result = $conn->query($getUser);
	$checkPass = $conn->query($checkPassword);
  }
    if($result->num_rows != 1 || $checkPass->num_rows != 1){
      $errorMessage = "Incorrect username or password, Please Try Again.";
	
    }else{
      $_SESSION['loginUser'] = $loginUsername;
      if($userType == "applicant"){
      header('Location: index.php');}
      else if($userType == "uniadmin"){header('Location: index.php');}
        else{header('Location: adminLogin.php');}
    }
  }

 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="description" content="">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

     <!-- Title -->
     <title>Academy - Education Course Template</title>

     <!-- Favicon -->
     <link rel="icon" href="img/core-img/favicon.ico">

     <!-- Core Stylesheet -->
     <link rel="stylesheet" href="style.css">

 </head>

 <body>
     <!-- ##### Preloader ##### -->
     <div id="preloader">
         <i class="circle-preloader"></i>
     </div>

     <!-- ##### Header Area Start ##### -->
     <header class="header-area">

         <!-- Top Header Area -->
         <div class="top-header">
             <div class="container h-100">
                 <div class="row h-100">
                     <div class="col-12 h-100">
                         <div class="header-content h-100 d-flex align-items-center justify-content-between">
                             <div class="academy-logo">
                                 <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                             </div>
                             <div class="login-content">
                                 <a href="#">Register / Login</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Navbar Area -->
         <div class="academy-main-menu">
             <div class="classy-nav-container breakpoint-off">
                 <div class="container">
                     <!-- Menu -->
                     <nav class="classy-navbar justify-content-between" id="academyNav">

                         <!-- Navbar Toggler -->
                         <div class="classy-navbar-toggler">
                             <span class="navbarToggler"><span></span><span></span><span></span></span>
                         </div>

                         <!-- Menu -->
                         <div class="classy-menu">

                             <!-- close btn -->
                             <div class="classycloseIcon">
                                 <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                             </div>

                             <!-- Nav Start -->
                             <div class="classynav">
                                 <ul>
                                     <li><a href="index.php">Home</a></li>
                                     <li><a href="#">Pages</a>
                                         <ul class="dropdown">
                                             <li><a href="index.html">Home</a></li>
                                             <li><a href="about-us.html">About Us</a></li>
                                             <li><a href="course.html">Course</a></li>
                                             <li><a href="blog.html">Blog</a></li>
                                             <li><a href="contact.html">Contact</a></li>
                                             <li><a href="elements.html">Elements</a></li>
                                         </ul>
                                     </li>
                                     <li><a href="#">Mega Menu</a>
                                         <div class="megamenu">
                                             <ul class="single-mega cn-col-4">
                                                 <li><a href="#">Home</a></li>
                                                 <li><a href="#">Services &amp; Features</a></li>
                                                 <li><a href="#">Accordions and tabs</a></li>
                                                 <li><a href="#">Menu ideas</a></li>
                                                 <li><a href="#">Students Gallery</a></li>
                                             </ul>
                                             <ul class="single-mega cn-col-4">
                                                 <li><a href="#">Home</a></li>
                                                 <li><a href="#">Services &amp; Features</a></li>
                                                 <li><a href="#">Accordions and tabs</a></li>
                                                 <li><a href="#">Menu ideas</a></li>
                                                 <li><a href="#">Students Gallery</a></li>
                                             </ul>
                                             <ul class="single-mega cn-col-4">
                                                 <li><a href="#">Home</a></li>
                                                 <li><a href="#">Services &amp; Features</a></li>
                                                 <li><a href="#">Accordions and tabs</a></li>
                                                 <li><a href="#">Menu ideas</a></li>
                                                 <li><a href="#">Students Gallery</a></li>
                                             </ul>
                                             <div class="single-mega cn-col-4">
                                                 <img src="img/bg-img/bg-1.jpg" alt="">
                                             </div>
                                         </div>
                                     </li>
                                     <li><a href="about-us.html">About Us</a></li>
                                     <li><a href="course.html">Course</a></li>
                                     <li><a href="contact.html">Contact</a></li>
                                 </ul>
                             </div>
                             <!-- Nav End -->
                         </div>

                         <!-- Calling Info -->
                         <div class="calling-info">
                             <div class="call-center">
                                 <a href="tel:+654563325568889"><i class="icon-telephone-2"></i> <span>(+65) 456 332 5568 889</span></a>
                             </div>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>
     </header>
     <!-- ##### Header Area End ##### -->
     <?php

     								?>
     <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
         <div class="bradcumbContent">
             <h2>Sign in</h2>
         </div>
     </div>
     <!-- ##### Breadcumb Area End ##### -->

     <!-- ##### About Us Area Start ##### -->
     <section class="about-us-area mt-50 section-padding-100">
         <div class="container">
           <div class="contact-content">

               <div class="col-12">
                   <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                     <form action="" method="post">
                          <div class="form-label-group">
                          <input type="text" name="loginUsername" id="loginUsername" class="form-control" placeholder="Username">
                          <span id="loginUsername" class="error"></span>
                          <label for="loginUsername">Username</label>
                    </div>
                    <div class="form-label-group">
                          <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="Password" >
                          <span id="loginPassword" class="error"><?php if($errorMessage != ""){echo $errorMessage;}?></span>
                          <label for="loginPassword">Password</label>
                    </div>
                    <div class="form-group">
                      <label for="userType">Sign in as:</label>
                      <select id="selectIDType" name="userType" class="form-control">
                        <option value="applicant" selected="">Applicant</option>
                        <option value="uniadmin">Uni Admin</option>
                        <option value="sasadmin">SAS Admin</option>
                      </select>
                    </div>
                  <div class="register">
                    <a href="signup.php" style="font-size:12px">Don't have account? Register here</a>
                          </div>
                    <input type="submit" class="btn academy-btn mt-30" value="Login">
                         </form>
                   </div>
               </div>
             </div>
         </div>
     </section>

     <!-- ##### Footer Area Start ##### -->
     <footer class="footer-area">
         <div class="main-footer-area section-padding-100-0">
             <div class="container">
                 <div class="row">
                     <!-- Footer Widget Area -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="footer-widget mb-100">
                             <div class="widget-title">
                                 <a href="#"><img src="img/core-img/logo2.png" alt=""></a>
                             </div>
                             <p>Cras vitae turpis lacinia, lacinia lacus non, fermentum nisi. Donec et sollicitudin est, in euismod erat. Ut at erat et arcu pulvinar cursus a eget.</p>
                             <div class="footer-social-info">
                                 <a href="#"><i class="fa fa-facebook"></i></a>
                                 <a href="#"><i class="fa fa-twitter"></i></a>
                                 <a href="#"><i class="fa fa-dribbble"></i></a>
                                 <a href="#"><i class="fa fa-behance"></i></a>
                                 <a href="#"><i class="fa fa-instagram"></i></a>
                             </div>
                         </div>
                     </div>
                     <!-- Footer Widget Area -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="footer-widget mb-100">
                             <div class="widget-title">
                                 <h6>Usefull Links</h6>
                             </div>
                             <nav>
                                 <ul class="useful-links">
                                     <li><a href="#">Home</a></li>
                                     <li><a href="#">Services &amp; Features</a></li>
                                     <li><a href="#">Accordions and tabs</a></li>
                                     <li><a href="#">Menu ideas</a></li>
                                 </ul>
                             </nav>
                         </div>
                     </div>
                     <!-- Footer Widget Area -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="footer-widget mb-100">
                             <div class="widget-title">
                                 <h6>Gallery</h6>
                             </div>
                             <div class="gallery-list d-flex justify-content-between flex-wrap">
                                 <a href="img/bg-img/gallery1.jpg" class="gallery-img" title="Gallery Image 1"><img src="img/bg-img/gallery1.jpg" alt=""></a>
                                 <a href="img/bg-img/gallery2.jpg" class="gallery-img" title="Gallery Image 2"><img src="img/bg-img/gallery2.jpg" alt=""></a>
                                 <a href="img/bg-img/gallery3.jpg" class="gallery-img" title="Gallery Image 3"><img src="img/bg-img/gallery3.jpg" alt=""></a>
                                 <a href="img/bg-img/gallery4.jpg" class="gallery-img" title="Gallery Image 4"><img src="img/bg-img/gallery4.jpg" alt=""></a>
                                 <a href="img/bg-img/gallery5.jpg" class="gallery-img" title="Gallery Image 5"><img src="img/bg-img/gallery5.jpg" alt=""></a>
                                 <a href="img/bg-img/gallery6.jpg" class="gallery-img" title="Gallery Image 6"><img src="img/bg-img/gallery6.jpg" alt=""></a>
                             </div>
                         </div>
                     </div>
                     <!-- Footer Widget Area -->
                     <div class="col-12 col-sm-6 col-lg-3">
                         <div class="footer-widget mb-100">
                             <div class="widget-title">
                                 <h6>Contact</h6>
                             </div>
                             <div class="single-contact d-flex mb-30">
                                 <i class="icon-placeholder"></i>
                                 <p>4127/ 5B-C Mislane Road, Gibraltar, UK</p>
                             </div>
                             <div class="single-contact d-flex mb-30">
                                 <i class="icon-telephone-1"></i>
                                 <p>Main: 203-808-8613 <br>Office: 203-808-8648</p>
                             </div>
                             <div class="single-contact d-flex">
                                 <i class="icon-contract"></i>
                                 <p>office@yourbusiness.com</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="bottom-footer-area">
             <div class="container">
                 <div class="row">
                     <div class="col-12">
                         <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
 Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                     </div>
                 </div>
             </div>
         </div>
     </footer>
     <!-- ##### Footer Area Start ##### -->

     <!-- ##### All Javascript Script ##### -->
     <!-- jQuery-2.2.4 js -->
     <script src="js/jquery/jquery-2.2.4.min.js"></script>
     <!-- Popper js -->
     <script src="js/bootstrap/popper.min.js"></script>
     <!-- Bootstrap js -->
     <script src="js/bootstrap/bootstrap.min.js"></script>
     <!-- All Plugins js -->
     <script src="js/plugins/plugins.js"></script>
     <!-- Active js -->
     <script src="js/active.js"></script>
 </body>

 </html>
