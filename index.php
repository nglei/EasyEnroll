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

$createUserTb = "CREATE TABLE user(username varchar(50) PRIMARY KEY,password varchar(25),
email varchar(40),name varchar(40) )";
$conn->query($createUserTb);

$createAdminTb = "CREATE TABLE sasadmin(username varchar(50) PRIMARY KEY,password varchar(25),
email varchar(40),name varchar(40) )";
$conn->query($createAdminTb);

$addAdmin ="  INSERT into sasadmin values('admin1','admin123','admin@gmail.com','Admin One')";
$conn->query($addAdmin);

$createApplicantTb = "CREATE TABLE applicant(
username varchar(50) PRIMARY KEY,
idtype varchar(10),
idno varchar(20),
mobileNo varchar(14),
dateOfBirth date,
foreign key (username) references user(username))";
$conn->query($createApplicantTb);

$createQualificationTb ="CREATE TABLE qualification(
qualificationID int auto_increment not null primary key,
qualificationName varchar(50),
minimumScore int(10),
maximumScore int(10),
method varchar(20),
numOfSubject int(5),
gradeList varchar(200))";
$conn->query($createQualificationTb);

$setIDindex = "alter table qualification AUTO_INCREMENT=10001";
$conn->query($setIDindex);

$qualificationObtainedTb = "CREATE table qualificationObtained(
qobtainedID int auto_increment primary key not null,
username varchar(50),
qualificationID int,
overallScore int(10),
foreign key (username) references user(username),
foreign key (qualificationID) references qualification(qualificationID))";
$conn->query($qualificationObtainedTb);

$setID = "alter table qualificationObtained AUTO_INCREMENT=20001";
$conn->query($setID);

$resultTb = "CREATE table result(
resultID int not null auto_increment primary key,
username varchar(50),
subject varchar(30),
grade varchar(5),
foreign key (username) references user(username))";
$conn->query($resultTb);

$programmeTb = "create table programme(
programmeID int auto_increment primary key not null,
UniID VARCHAR(12),
programmeName varchar(1000),
duration varchar(50),
totalFee int(10),
progDescription varchar(2000),
closingDate date,
imgURL varchar(200),
foreign key (UniID) references university(UniID))";
$conn->query($programmeTb);

$setProgID = "alter table programme AUTO_INCREMENt = 40001";
$conn->query($setProgID);

$entryReqTb = "create table entryReq(
programmeID int,
qualificationID int,
entryScore decimal(6,1),
foreign key (programmeID) references programme(programmeID),
foreign key (qualificationID) references qualification(qualificationID))";
$conn->query($entryReqTb);

$applicationTb = "create table application(
applicationID int auto_increment primary key,
applicationDate date,
applicationStatus varchar(20),
applicant varchar(50),
progID int,
foreign key (applicant) references applicant(username),
foreign key (progID) references programme(programmeID));";
$conn->query($applicationTb);

$setapplicationID = "alter table application AUTO_INCREMENt = 60001";
$conn->query($setapplicationID);

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
     <link rel="icon" href="img/bg-img/EasyEnroll.png">

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
                                 <a href="index.html"><img src="img/bg-img/EasyEnroll.png" alt="" height="102vh" width="88vh"></a>
                             </div>
                             <div class="login-content">
                                 <!--a href="signin.php" class="blueLink13"></a-->
                                 <?php
                                 if(isset($_SESSION['loginUser'])){
									               echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
												   $getName = "select * from user where username ='".$_SESSION['loginUser']."'";
												   $user=$conn->query($getName);
												   if($user->num_rows > 0){
													   while($name = $user->fetch_assoc()){
														   echo "Welcome, ".$name['name']."</a>";
													   }
												   }
									               
									               echo "<div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
									               echo "<a class='dropdown-item' href='signout.php'>Logout</a></div>";


                                 }else{
                                   echo "<a href='signin.php' class='blueLink13'>";
                                   echo "Register / Login";
                                   echo "</a>";
                                 }
                                 ?>
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
                                             <li><a href="index.php">Home</a></li>
                                             <li><a href="addUniversity.php">Add University</a></li>
                                             <li><a href="addProgramme.html">Course</a></li>
                                             <li><a href="addQualification.html">Programme</a></li>
                                             <li><a href="contact.html">Apply Now</a></li>
                                             <li><a href="elements.html">Contact</a></li>

                                         </ul>
                                     </li>
                                     <li><a href="#">Universities</a>
                                         <div class="megamenu">
                                             <ul class="single-mega cn-col-4">
                                                 <li><a href="index.html">Home</a></li>
                                                 <li><a href="#">Yale University</a></li>
                                                 <li><a href="#">Tokyo University</a></li>
                                                 <li><a href="#">National Technology University</a></li>
                                                 <li><a href="#">National University Singapore</a></li>
                                             </ul>
                                             <ul class="single-mega cn-col-4">
                                                 <li><a href="#">University Kebangsaan Malaysia</a></li>
                                                 <li><a href="#">University Islam </a></li>
                                                 <li><a href="#">University Teknologi Malaysia</a></li>
                                                 <li><a href="#">SEGI</a></li>
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
                                     <li><a href="course.php">Course</a></li>
                                     <li><a href="contact.html">Contact</a></li>
                                 </ul>
                             </div>
                             <!-- Nav End -->
                         </div>

                         <!-- Calling Info -->
                         <div class="calling-info">
                             <div class="call-center">
                                 <a href="tel:+60108811385"><i class="icon-telephone-2"></i> <span>(+6010) 8811385</span></a>
                             </div>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>
     </header>
     <!-- ##### Header Area End ##### -->

     <!-- ##### Hero Area Start ##### -->
     <section class="hero-area">
         <div class="hero-slides owl-carousel">

             <!-- Single Hero Slide -->
             <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg-1_1replace.jpg);">
                 <div class="container h-100">
                     <div class="row h-100 align-items-center">
                         <div class="col-12">
                             <div class="hero-slides-content">
                                 <h4 data-animation="fadeInUp" data-delay="100ms">Your success, we assured</h4>
                                 <h2 data-animation="fadeInUp" data-delay="400ms">Welcome to Student Application System<br>EasyEnroll</h2>
                                 <a href="#" class="btn academy-btn" data-animation="fadeInUp" data-delay="700ms">E.E.S</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Single Hero Slide -->
             <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg_2-1.jpg);">
                 <div class="container h-100">
                     <div class="row h-100 align-items-center">
                         <div class="col-12">
                             <div class="hero-slides-content">
                                 <h4 data-animation="fadeInUp" data-delay="100ms">Excellent achievements Successful future</h4>
                                 <h2 data-animation="fadeInUp" data-delay="400ms">Welcome to our <br>Easy Enroll</h2>
                                 <a href="#" class="btn academy-btn" data-animation="fadeInUp" data-delay="700ms">Read More</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- ##### Hero Area End ##### -->

     <!-- ##### Top Feature Area Start ##### -->
     <div class="top-features-area wow fadeInUp" data-wow-delay="300ms">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="features-content">
                         <div class="row no-gutters">
                             <!-- Single Top Features -->
                             <div class="col-12 col-md-4">
                                 <div class="single-top-features d-flex align-items-center justify-content-center">
                                     <i class="icon-agenda-1"></i>
                                     <h5>Programme / Course</h5>
                                 </div>
                             </div>
                             <!-- Single Top Features -->
                             <div class="col-12 col-md-4">
                                 <div class="single-top-features d-flex align-items-center justify-content-center">
                                     <i class="icon-assistance"></i>
                                     <h5>One-click Management</h5>
                                 </div>
                             </div>
                             <!-- Single Top Features -->
                             <div class="col-12 col-md-4">
                                 <div class="single-top-features d-flex align-items-center justify-content-center">
                                     <i class="icon-contract"></i>
                                     <h5>Great Support</h5>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### Top Feature Area End ##### -->

     <!-- ##### Course Area Start ##### -->
     <div class="academy-courses-area section-padding-100-0">
         <div class="container">
             <div class="row">
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="300ms">
                         <div class="course-icon">
                             <i class="icon-id-card"></i>
                         </div>
                         <div class="course-content">
                             <h4>Sign UP</h4>
                             <p>Come on and join us our big family!</p>
                         </div>
                     </div>
                 </div>
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="400ms">
                         <div class="course-icon">
                             <i class="icon-worldwide"></i>
                         </div>
                         <div class="course-content">
                             <h4>Maintain Qualification</h4>
                             <p>Check out what course are you qualified</p>
                         </div>
                     </div>
                 </div>
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                         <div class="course-icon">
                             <i class="icon-map"></i>
                         </div>
                         <div class="course-content">
                             <h4>Register University</h4>
                             <p>We have hundreds of renowned universities registered in system. Contact us to be one of them!</p>
                         </div>
                     </div>
                 </div>
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="600ms">
                         <div class="course-icon">
                             <i class="icon-like"></i>
                         </div>
                         <div class="course-content">
                             <h4>Record Programme</h4>
                             <p>Thousands of programs we have in here! Tired to go along variety websites to search for your interested one? Find out here in just one-click</p>
                          </div>
                     </div>
                 </div>
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="700ms">
                         <div class="course-icon">
                             <i class="icon-responsive"></i>
                         </div>
                         <div class="course-content">
                             <h4>Apply for Programme</h4>
                             <p>Simplified and rapid process to apply for your course!</div>
                     </div>
                 </div>
                 <!-- Single Course Area -->
                 <div class="col-12 col-sm-6 col-lg-4">
                     <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="800ms">
                         <div class="course-icon">
                             <i class="icon-message"></i>
                         </div>
                         <div class="course-content">
                             <h4>Review Application</h4>
                             <p>A quick grasp to all application available for your university program</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### Course Area End ##### -->

     <!-- ##### Testimonials Area Start ##### -->
     <div class="testimonials-area section-padding-100 bg-img bg-overlay" style="background-image: url(img/bg-img/bg-2.jpg);">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="section-heading text-center mx-auto white wow fadeInUp" data-wow-delay="300ms">
                         <span>What do we have</span>
                         <h3>See the reasons why we are the best</h3>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <!-- Single Testimonials Area -->
                 <div class="col-12 col-md-6">
                     <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="400ms">

                         <div class="testimonial-content">
                             <h5>Manage more applications with less work done</h5>
                             <h6>Organised and smooth workflow</h6>
                             <p>Manage much more applications as possible with our befitting capacity of storage provided in system. A simplified interface and functionalities smoothen management on applications workflow. Complicated and multiple steps are taken out . </p>
                             <!--<p>From the features standpoint, the system is easy to use even a non-tech savvy like me can easily search the course I want. Whenever I found a course that is so interesting to stop me by, I can immediately know </p>
                             <h6><span>Maria Smith,</span> Student</h6>-->
                         </div>
                     </div>
                 </div>
                 <!-- Single Testimonials Area -->
                 <div class="col-12 col-md-6">
                     <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="500ms">
                         <div class="testimonial-content">
                             <h5>Handle your applicants has never been so easy</h5>
                             <p>Applicants' list are filtered, categorised and managed well accordingly to respective qualifications, results and grades. propose the best choice for the applicant that meets both the demands from the applicant and the requirements from the offerors</p>
                             </div>
                     </div>
                 </div>
                 <!-- Single Testimonials Area -->
                 <div class="col-12 col-md-6">
                     <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="600ms">
                         <div class="testimonial-content">
                             <h5>Variety of courses available from universities all across country</h5>
                             <p>We have multiple kinds of courses from every prospects of subjects and career aspects. Science, Business, Design, Accounting, Cutlery, Engineering... Also, we have provided similar courses from different universities to be compared and considered from without the needs of regular visting on two different universities sites to compare with in this single uniform platform</p>
                             <!--p>Large storage of database enables to store all sorts kinds of files which can provide more detailed information about applicants.Select your best-fit applicants with built-in scoring and evaluation tools, including automated video interviews, and scoresheets that you can easily share with your professors and department.</p-->

                         </div>
                     </div>
                 </div>
                 <!-- Single Testimonials Area -->
                 <div class="col-12 col-md-6">
                     <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="700ms">
                         <!--div class="testimonial-thumb">
                             <img src="img/bg-img/t4.jpg" alt="">
                         </div-->
                         <div class="testimonial-content">
                             <h5>Analyse the data and information submitted with clear and organised way</h5>
                             <p>All course are categorised and rated generally by thousands of reviewers. Maintain a constant overview of your admission process with clear reporting, export wizards and a full-featured dashboard. EasyEnroll has a quick and intuitive setup flow to fit your exact needs. </p>

                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12">
                     <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="800ms">
                         <a href="#" class="btn academy-btn">See More</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### Testimonials Area End ##### -->

     <!-- ##### Top Popular Courses Area Start ##### -->
     <div class="top-popular-courses-area section-padding-100-70">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                         <span>The Best</span>
                         <h3>Top Popular Courses</h3>
                     </div>
                 </div>
             </div>
             <div class="row">

                 <!-- Single Top Popular Course -->
                 <div class="col-12 col-lg-6">
                     <div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">
                         <div class="popular-course-content">
                             <h5>Bachelor of Engineering (Hons) Mechanical Engineering</h5>
                             <span>University of Tunku Abdul Rahman   |  UTAR</span>
                             <div class="course-ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                             </div>
                             <p>The programme is to produce engineering graduates with the ability to acquire and apply knowledge of science and engineeri...</p>
                             <a href="#" class="btn academy-btn btn-sm">See More</a>
                         </div>
                         <div class="popular-course-thumb bg-img" style="background-image: url(img/bg-img/pc-1.jpg);"></div>
                     </div>
                 </div>

                 <!-- Single Top Popular Course -->
                 <div class="col-12 col-lg-6">
                     <div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="500ms">
                         <div class="popular-course-content">
                             <h5>Bachelor Of Engineering (HONS) Electronics (Computer Networking) </h5>
                             <span>University of Tunku Abdul Rahman   |  UTAR</span>
                             <div class="course-ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                             </div>
                             <p>This is a unique engineering programme with a very practical and applied focus. Building on the fundamentals of electron...</p>
                             <a href="#" class="btn academy-btn btn-sm">See More</a>
                         </div>
                         <div class="popular-course-thumb bg-img" style="background-image: url(img/bg-img/utar-png800resize.png);"></div>
                     </div>
                 </div>

                 <!-- Single Top Popular Course -->
                 <div class="col-12 col-lg-6">
                     <div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="600ms">
                         <div class="popular-course-content">
                             <h5>Bachelor of Arts (HONS) Interior Design</h5>
                             <span>Taylor's University   |  Taylor's</span>
                             <div class="course-ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                             </div>
                             <p>The Taylor's Bachelor of Arts (Honours) Interior Architecture delivers 121 / 122 / 123 credits units with 12 units for ind..</p>
                             <a href="#" class="btn academy-btn btn-sm">See More</a>
                         </div>
                         <div class="popular-course-thumb bg-img" style="background-image: url(img/bg-img/taylors-2-resize.jpg);"></div>
                     </div>
                 </div>

                 <!-- Single Top Popular Course -->
                 <div class="col-12 col-lg-6">
                     <div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="700ms">
                         <div class="popular-course-content">
                             <h5>Bachelor of Business Administration (HONS)</h5>
                             <span>University of Malaya   |  UM</span>
                             <div class="course-ratings">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star" aria-hidden="true"></i>
                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                             </div>
                             <p>Business education in the University of Malaya (UM) dates back to 1966 when the Faculty of Economics and Administration fir...</p>
                             <a href="#" class="btn academy-btn btn-sm">See More</a>
                         </div>
                         <div class="popular-course-thumb bg-img" style="background-image: url(img/bg-img/um-logo800.png);"></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### Top Popular Courses Area End ##### -->

     <!-- ##### Partner Area Start ##### -->
     <div class="partner-area section-padding-0-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="partners-logo d-flex align-items-center justify-content-between flex-wrap">
                         <a href="#"><img src="img/clients-img/partner-1.png" alt=""></a>
                         <a href="#"><img src="img/clients-img/partner-2.png" alt=""></a>
                         <a href="#"><img src="img/clients-img/partner-3.png" alt=""></a>
                         <a href="#"><img src="img/clients-img/partner-4.png" alt=""></a>
                         <a href="#"><img src="img/clients-img/partner-5.png" alt=""></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### Partner Area End ##### -->

     <!-- ##### CTA Area Start ##### -->
     <div class="call-to-action-area">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="cta-content d-flex align-items-center justify-content-between flex-wrap">
                         <h3>Do you want to enrole at our Academy? Get in touch!</h3>
                         <a href="#" class="btn academy-btn">See More</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ##### CTA Area End ##### -->

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
