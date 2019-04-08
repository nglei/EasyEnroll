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


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$qualName = $_POST['qualificationName'];
	$minS = $_POST['minScore'];
	$maxS = $_POST['maxScore'];
	$calc = $_POST['calcMethod'];
	$noSub = $_POST['subNum'];
	$gradeL = $_POST['gradelist'];
	
	$updateQualification ="UPDATE qualification set qualificationName = '$qualName' , minimumScore = $minS,maximumScore = $maxS,method='$calc',numOfSubject=$noSub,gradeList = '$gradeL' where qualificationID = ".$_SESSION['qID'];
	$conn-> query($updateQualification);
	
	echo "<script>alert ('Qualification updated.');window.location.href = 'qualificationList.php';</script>";
	
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
												   $getName = "select * from sasadmin where username ='".$_SESSION['loginUser']."'";
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
                                   <li><a href="adminLogin.php">Home</a></li>
                                   <li><a href="qualificationList.php">Qualification</a></li>
                                   <li><a href="addUniversity.php">University</a></li>
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
     <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
         <div class="bradcumbContent">
             <h2>Qualification Details</h2>
         </div>
     </div>
     <!-- ##### Breadcumb Area End ##### -->
<?php
$getQualification = "SELECT * from qualification where qualificationID = ".$_GET['qID'];
$result = $conn->query($getQualification);
$qualificationName ="";
$minScore ="";
$maxScore = "";
$method ="";
$numOfSub = "";
$gradeList="";
$_SESSION['qID'] = $_GET['qID'];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
		$qualificationName = $row['qualificationName'];
		$minScore =$row['minimumScore'];
		$maxScore = $row['maximumScore'];
		$method = $row['method'];
		$numOfSub = $row['numOfSubject'];
		$gradeList=$row['gradeList'];
		$qualificationID = $row['qualificationID'];

	}
}
?>
     <!-- ##### About Us Area Start ##### -->
     <section class="about-us-area mt-50 section-padding-100">
         <div class="container">
           <div class="contact-content">

               <div class="col-12">
                   <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                     <form action="viewQualification.php" method="post" onsubmit="return validation()" id="viewQualification">
     <div>
     <label for="qualificationName">Qualification Name</label>
                         <input type="text" id="qualificationName" name="qualificationName" class="form-control" disabled>
                         <span id="errorQualification" class="error"></span>
                         </div>
     <div>
     <label for="minScore">Minimum Score</label>
                         <input type="text" id="minScore" name="minScore" class="form-control" disabled>
                         <span id="errorMinScore" class="error"></span>
                         </div>
     <div>
                         <label for="maxScore">Maximum Score</label>
     <input type="text" id="maxScore" name="maxScore" class="form-control" disabled>
                         <span id="errorMaxScore" class="error"></span>
                         </div>
     <div>
     <label>Overall Result Calculation</label>
     <div class="row">
     <div class ="col-6">
     <select id="calcMethod" name="calcMethod" class="form-control" disabled >
     <option value="" disabled="" selected="">Calculation Type</option>
     <option value="average">Average</option>
     <option value="total">Total</option>
     </select>
     <span id="errorMethod" class="error"></span>
     </div>
     <div class ="col-6">
     <input type="text" id="subNum" name="subNum" class="form-control" disabled>
     <span id="errorSubNum" class="error"></span>
     </div>
     </div>
     </div>

     <div id="myModal" class="modal">

     <!-- Modal content -->
     <div class="modal-content">
     <span class="close">&times;</span>
     <h6> Grade List</h6>
     <p>A   (4.00)<br>
     A-	(3.67)<br>
     B+ (3.33)<br>
     B    (3.00)<br>
     B-  (2.67)<br>
     C+  (2.33)<br>
     C   (2.00)<br>
     B+ (1.67)<br>
     D+ (1.33)<br>
     D  (1.00)<br>
     F  (0.00)<br>
     </p>
     </div>

     </div>


     <div>
     <label>Grade List</label><button id="example" type="button" class="btn btn-link btn-sm">Example</button>
                         <textarea name="gradelist" class="form-control" id="gradelist" cols="30" rows="10" disabled><?php echo $gradeList;?></textarea>
     <span id="errorGradeList" class="error"></span>
     </div>
	 <div class = "text-center">

     <button type="button" id="edit" class="btn academy-btn mt-30 " onclick="enable()">Edit Qualification</button>

		<button type="button" id= "save"  class="btn academy-btn mt-30 " onclick="location.href=('qualificationList.php')" >Back To List</button>
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
	 <script>
	 var method = document.getElementById('calcMethod');
	 var gradeList = document.getElementById('gradelist');
	 var qualificationName = document.getElementById('qualificationName');
	 var minScore = document.getElementById('minScore');
	 var maxScore = document.getElementById('maxScore');
	 var numOfSubject = document.getElementById('subNum');
	 var save = document.getElementById('save');
	 var edit = document.getElementById('edit');

	 gradeList.style.backgroundColor = "silver";
	 method.style.backgroundColor = "silver";
	 <?php
	 echo "method.value ='". $method."';";
	 echo "qualificationName.value ='". $qualificationName."';";
	 echo "minScore.value ='". $minScore."';";
	 echo "maxScore.value ='". $maxScore."';";
	 echo "numOfSubject.value ='". $numOfSub."';";
	 //echo "gradeList.innerHTML ='".$gradeList."';";
	 ?>


	 function enable(){
		method.disabled = false;
		gradeList.disabled = false;
		qualificationName.disabled = false;
		minScore.disabled = false;
		maxScore.disabled = false;
		numOfSubject.disabled = false;
		qualificationName.style.fontWeight = "normal";
		gradeList.style.fontWeight = "normal";
		method.style.fontWeight = "normal";
		minScore.style.fontWeight = "normal";
		maxScore.style.fontWeight = "normal";
		numOfSubject.style.fontWeight = "normal";
		gradeList.style.backgroundColor = "	#eef3f6";
		qualificationName.style.backgroundColor = "#eef3f6";
		minScore.style.backgroundColor = "#eef3f6";
		maxScore.style.backgroundColor = "#eef3f6";
		method.style.backgroundColor = "#eef3f6";
		numOfSubject.style.backgroundColor = "#eef3f6";

		save.innerHTML = "Save";
		save.setAttribute("type","submit");
		qualificationName.focus();
		edit.innerHTML = 'Cancel';
		<?php
		echo "edit.onclick = function () {";
        echo "location.href = 'viewQualification.php?qID=".$_SESSION['qID']."';}";
		?>



	 }

	 </script>

	 	<script>

var modal = document.getElementById('myModal');
var btn = document.getElementById("example");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
     <script src = "js/addQualification.js"></script>
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
