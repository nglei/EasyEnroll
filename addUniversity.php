<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername,$username,$password);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "Connect successfully";
$uniName="";
$sql = "CREATE DATABASE IF NOT EXISTS easyenroll";
if($conn->query($sql) === TRUE){
    echo "Database created successfully";
}else{
    echo "Error create database: " . $conn->error;
}
$sqlUseDb = "USE easyenroll";
$sqlcreateTbl = "CREATE TABLE IF NOT EXISTS University (
    UniID VARCHAR(12) PRIMARY KEY DEFAULT '0' NOT NULL, UniName VARCHAR(55), adminUsername VARCHAR(50), foreign KEY (adminUsername) references user(username));";
    if($conn->query($sqlUseDb) === TRUE){
        echo "Use Database Successful";
    }
    else{
        echo "Error Using Database " . $conn->error;
    }
    if($conn->query($sqlcreateTbl)===TRUE){
        echo "Create Table Successfully";
    }
    else{
        echo "Error creating table " . $conn->error;
    }
    $sqlcreateuniIndexTbl = "CREATE TABLE IF NOT EXISTS UniIndexTable( id INT PRIMARY KEY NOT NULL AUTO_INCREMENT);";
    if ($conn->query($sqlcreateuniIndexTbl) === TRUE){
        echo "Create uniIndex Table successful";
    }
    else{
        echo "Error creating uniIndex table " . $conn->error;
    }
    $sqlcreatetriggeruninumindex = "CREATE TRIGGER uniIndex_trigger BEFORE INSERT ON University FOR EACH ROW BEGIN INSERT INTO UniIndexTable VALUES(NULL); SET NEW.UniID = CONCAT('U',IF(LAST_INSERT_ID()>999,LAST_INSERT_ID(),LPAD(LAST_INSERT_ID(),'3','0')));END ";
    
    if($conn ->query($sqlcreatetriggeruninumindex) === TRUE){
        echo "Create Trigger Successfully";
    }
    else{
        echo "Error Create Trigger" . $conn->error;
    }
    $duplicateusername="";
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

           <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="header-content h-100 d-flex align-items-center justify-content-between">
                            <div class="academy-logo">
                                <a href="index.html"><img src="img/bg-img/EasyEnroll.png" alt="" height = "122vh" width="68vh"></a>
                            </div>
                            <div class="login-content">
                                <a href="//www.123formbuilder.com/form-4669784/school-admission-form" class="blueLink13">Register / Login</a>
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
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="#">Pages</a>
                                        
                                    <ul class="dropdown">
                                            <li><a href="index.html">Home</a></li>
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
                                    <li><a href="course.html">Course</a></li>
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

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Add University</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Google Maps ##### -->
    <div class="map-area wow fadeInUp" data-wow-delay="300ms">
        <div id="googleMap"></div>
    </div>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uniadminfull=$_POST['uniadminfullname'];
        $uniadminpassword=$_POST['uniadminpw'];
        $uniadminemail=$_POST['uniadminemail'];
        $uniadminusername=$_POST['uniadminusername'];
        if(isset($_POST['uniadminusername'])){
            $checkuserexist="SELECT username FROM user where username ='$uniadminusername';";
            $sameusername=$conn->query($checkuserexist);
            if($sameusername->num_rows>0){
                $duplicateusername="User exists. Please change a different username";
            }else{
                $recorduniadmin= "INSERT INTO USER VALUES('$uniadminusername','$uniadminpassword','$uniadminemail','$uniadminfull'); ";
                if($conn->query($recorduniadmin) === TRUE){
                    echo "Uni Admin Record Added Successfully";
                }
                else{
                     echo "Uni Admin Record: " . $conn->error;
                    }
                    /*University Register*/
                    $uniName = $_POST['uniName'];
                    $insertUni = "Insert into University (UniName,adminUsername) VALUES('$uniName','$uniadminusername');";
                    if($conn->query($insertUni) === TRUE){
                         echo "Data added successfully";
                        }
                        else{
                            echo "Error entering data " . $conn->error;
                        }
                    }
                }
        
        $conn->close();
    }
    ?>
    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-content">
                        <div class="row">
                            <!-- Contact Information -->
                            <div class="col-12 col-lg-5">
                                <div class="contact-information wow fadeInUp" data-wow-delay="400ms">
                                    <div class="section-heading text-left">
                                        <span>EasyEnroll</span>
                                        <h3>Add University</h3>
                                        <p class="mt-30">This site is restricted only for system admins to access in. System admins must aware of the data type requested in all the fields. Assign a university admins after register one university to in charge of this particular university</p>
                                    </div>

                                    <!-- Contact Social Info -->
                                    <div class="contact-social-info d-flex mb-30">
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </div>

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <p>4127/ 5B-C Mislane Road,<br> Gibraltar, UK</p>
                                    </div>

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-telephone-1"></i>
                                        </div>
                                        <p>Main: 203-808-8613 <br> Office: 203-808-8648</p>
                                    </div>

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-contract"></i>
                                        </div>
                                        <p>office@yourbusiness.com</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Form Area -->
                            <div class="col-12 col-lg-7">
                                <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return uniAdminValidation()" method="post">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" id="uniName" name="uniName"value="<?php echo $uniName;?>"placeholder="University Name (in full)" required>
                                        <label for="uniName">University Name</label>
                                        <span id="invalidUniName" class="error"></span>
                                        </div>
                                        <h6>University Admin Details Sign Up</h6>
                                        <div class="form-label-group">
                                        <input type="text" class="form-control" id="uniadminusername" name="uniadminusername" placeholder="marcus" required>
                                        <span id="errorUsername" class="error"><?php if(isset($_POST['uniadminusername'])){echo(" | " . $duplicateusername);}?></span>
                                        <label for="uniadminusername">University's Admin username (e.g. marcusliew@utar)</label>
                                        
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" class="form-control" id="uniadminpw" name ="uniadminpw" placeholder="password" required>
                                        <label for="uniadminpw">Password</label>
                                        <span id="invalidPW" class="error"></span>
                                        </div>
                                        <div class="form-label-group">
                                        <input type="text" class="form-control" id="uniadminfullname" name="uniadminfullname"placeholder="Fullname">
                                        <label for="uniadminfullname">NRIC Full Name</label>
                                        <span id="invalidFullName" class="error"></span>
                                        </div>
                                    <div class="form-label-group">
                                        <input type="email" class="form-control" id="uniadminemail" name="uniadminemail"placeholder="email" required>
                                        <span id="invalidEmail"></span>
                                        <label for="uniadminemail">Email</label>
                                        </div>
                                        <button class="btn academy-btn mt-30" type="submit">Add University</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ##### Contact Area End ##### -->

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
    <script src="js/addUniversity.js">
                                        
    </script>

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
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <script src="js/google-map/map-active.js"></script>
</body>

</html>
