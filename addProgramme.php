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

$getQualification = "SELECT qualificationID,qualificationName from qualification";
$qualification = $conn->query($getQualification);
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $programmeName = $_POST['programmeName'];
    $description = $_POST['description'];
    $closingDate = $_POST['closingDate'];
	$duration = $_POST['duration'];
	$fee = $_POST['fee'];
	$imageLocation = "img/prog-img/".$_FILES['uploadImage']['name'];
	move_uploaded_file($_FILES['uploadImage']['tmp_name'],$imageLocation);
	$UniID="";
	$getUniID = "select UniID from university where adminUsername = '".$_SESSION['loginUser']."'";
	$result = $conn->query($getUniID);
	if($result->num_rows == 1){
		while($uniid = $result->fetch_assoc()){
			$UniID = $uniid['UniID'];
		}
	}
	
    $insertProgramme ="INSERT into programme (UniID,programmeName,duration,totalFee,progDescription,closingDate,imgURL) values
    ('$UniID','$programmeName','$duration','$fee','$description','$closingDate','$imageLocation')";
    $conn->query($insertProgramme);
	
	$getID = "SELECT * FROM programme where programmeName='".$programmeName."' and progDescription = '".$description."' and closingDate = '".$closingDate."'";
	$programme = $conn->query($getID);
	$progID = "";
	if($programme->num_rows == 1){
		while($id = $programme->fetch_assoc()){
			$progID = $id['programmeID'];
		}
	}
	
	if($qualification->num_rows > 0){
        while($row = $qualification->fetch_assoc()){
			$qID = $row['qualificationID'];
			$entryReq = $_POST[$qID];
			$insertReq = "INSERT into entryreq (programmeID,qualificationID,entryScore) values ('$progID','$qID','$entryReq')";
			$conn->query($insertReq);
			
	}
	}
	
	header('location:programmeList.php');
        
    

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
                                <?php
                                 if(isset($_SESSION['loginUser'])){
									echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
									echo "Welcome, ".$_SESSION['loginUser']."</a>";
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
                                     <li><a href="uniadminLogin.php">Home</a></li>
                                     <li><a href="programmeList.php">Programme</a></li>
                                     <li><a href="#">Review Application</a></li>
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

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Add Programme</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Google Maps ##### -->


    <!-- ##### Contact Area Start ##### -->
    <section class="about-us-area mt-50 section-padding-100">
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
                                        <h3>Add Programme</h3>
                                        <p class="mt-30">Please enter the information carefully as faulty information may cause confusion and unnecessary disturbance to the system and the users. Textbox that only require numbers are strongly restrict to numbers only, e.g. Duration</p>
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
                                        <p>Main: 603-7780036 <br> Office: 011-8990110</p>
                                    </div>

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-contract"></i>
                                        </div>
                                        <p>office@easyenroll.com</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Form Area -->
                            <?php

                            ?>
                            <div class="col-12 col-lg-7">
                                <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                                    <form action="addProgramme.php" method="post" enctype="multipart/form-data" onsubmit="return (validation() && checkScore())">
										<div>
										<label for="programmeName">Programme Name</label>
                                        <input type="text" id="programmeName" name="programmeName" class="form-control" placeholder="Programme Name">
                                        <span id="errorProgramme" class="error"></span>
                                        </div>
										<div class="row">
										<div class = "col-6">
										<label for="duration">Duration</label>
                                        <input type="text" id="duration" name="duration" class="form-control" placeholder="eg. 3 year">
                                        <span id="errorDuration" class="error"></span>
										</div>
										<div class = "col-6">
										<label for="fee">Total Fee</label>
                                        <input type="text" id="fee" name="fee" class="form-control" placeholder="Cource Fee">
                                        <span id="errorFee" class="error"></span>
										</div>
										</div>
                                        <div>
                                        <label>Programme Description</label>
                                                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Programmme Description"></textarea>
                                        <span id="errorDescription" class="error"></span>
                                        </div>
                                        <div>
                                          <label for="closingDate">Closing Date</label>
                                          <input type="date" name="closingDate" id="closingDate" class="form-control">
                                          <span id="errorDate" class="error"></span>

                                        </div>
										<div>
										<label>Upload image for the programme</label>
										<input type="file" name="uploadImage">
										</div>
										
										<div>
										<br>
										<label>Entry Requirement for each qualification</label>
										<table class="table">
										<?php
                                                    if($qualification->num_rows > 0){
                                                              while($row = $qualification->fetch_assoc()){
																  echo "<tr>";
																  echo "<td>".$row["qualificationName"]."</td>";
																  echo "<td>";
																  echo "<div class='form-label-group'>";
																echo "<input type='text'  id = '".$row['qualificationID']."' name='".$row['qualificationID']."' class='form-control' placeholder='Score'>";
																echo "<label for='score'>Score</label>";
																echo "</div>";
																  echo "</td>";
																  echo "</tr>";
                                                                         
                                                                               }
                                                                                    }
										?>
										
										</table>
										</div>
										<span class="error" id="errorMessage"></span>

										
									
									<div>

                                        <input class="btn academy-btn mt-30" type="submit" value="Add Programme"></div>
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
	<script>
	var errorMessage = document.getElementById('errorMessage');
	function checkScore(){
	<?php
	
	$countEntry = 0;
	$getQualification = "SELECT qualificationID,qualificationName from qualification";
	$qualification = $conn->query($getQualification);
	if($qualification->num_rows > 0){
	while($row = $qualification->fetch_assoc()){
		$qID = $row["qualificationID"];
		echo "var entry".$countEntry." = document.getElementById('$qID');";	
		echo "if(entry".$countEntry.".value==''){errorMessage.innerHTML = 'Please enter entry score for all qualification';";
		echo "entry".$countEntry.".focus(); return false;}";
		
		$countEntry++;
	}
	}
	echo "else{return true;}";
	?>
	}
	</script>
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
	<script src = "js/addProgramme.js"></script>
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
