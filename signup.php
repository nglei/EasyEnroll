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
     $errorUsername = "";
     $errorResult = "";

     if($_SERVER["REQUEST_METHOD"] == "POST"){
     	$username = $_POST['username'];
		$password = $_POST['password'];
     	$name = $_POST['fullName'];
     	$email = $_POST['email'];
     	$idType = $_POST['idType'];
     	$idNo = $_POST['idNo'];
     	$mobileNo = $_POST['mobileNo'];
     	$date = $_POST['date'];
		$qualification = $_POST['qualification'];
    $subjectList = $_POST['subject'];
    $gradeList = $_POST['grade'];

     	if(isset($_POST['username'])){
     	$findUser = "SELECT username from user where username = '".$username."'";
     	$result = $conn->query($findUser);
      $getNumSubject = "SELECT numOfSubject from qualification where qualificationID='".$qualification."'";
      $noSubject = $conn->query($getNumSubject);
     	if($result->num_rows >=1){

        $save = array($username,$name,$email,$idType,$idNo,$mobileNo,$date,$qualification);
     		$errorUsername = "Username already exist.";
     	}
      if($noSubject->num_rows >=1){

        while($noSub = $noSubject->fetch_assoc()){
        if(sizeof($gradeList) < $noSub['numOfSubject']){
			$save = array($username,$name,$email,$idType,$idNo,$mobileNo,$date,$qualification);
            $errorResult = "Must at least enter ".$noSub['numOfSubject']." subject and ".$noSub['numOfSubject']." score";
        }
      }
      }
      if($errorUsername == "" && $errorResult ==""){

     	$insertUser = "INSERT into user (username,password,email,name) values('$username','$password','$email','$name')";
     	$conn->query($insertUser);

     	$insertApplicant = "INSERT into applicant (username,idtype,idno,mobileNo,dateOfBirth) values('$username','$idType','$idNo','$mobileNo','$date')";
		  $conn->query($insertApplicant);



      $getMethod = "SELECT method,numOfSubject from qualification where qualificationID = '".$qualification."'";
      $methodRow = $conn->query($getMethod);
      $overallScore = 0;
      if($methodRow->num_rows > 0){
                while($row = $methodRow->fetch_assoc()){
                  $method = $row["method"];
                  $numOfSubject = $row["numOfSubject"];
                  if($method == "total"){
                    rsort($gradeList);
                    for($i = 0;$i < $numOfSubject ;$i++){
                      $overallScore =  ($overallScore + $gradeList[$i]);
                    }
                  }else{
					for($i = 0;$i < $numOfSubject ;$i++){
						rsort($gradeList);
                      $overallScore =  ($overallScore + $gradeList[$i]);
                    }
					$overallScore = ($overallScore / $numOfSubject);
				  }
                }}

     	$insertQualObtained = "INSERT into qualificationobtained (username,qualificationID,overallScore) values ('$username','$qualification','$overallScore')";
		  $conn->query($insertQualObtained);



      for($i = 0;$i < sizeof($subjectList) ;$i++){
        $subject = $subjectList[$i];
        $grade = $gradeList[$i];
        $insertResult = "INSERT into result (username,subject,grade) values('$username','$subject','$grade')";
     		$conn->query($insertResult);
      }

     	}
     	}

     }
      ?>
     <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
         <div class="bradcumbContent">
             <h2>Sign up</h2>
         </div>
     </div>
     <!-- ##### Breadcumb Area End ##### -->

     <!-- ##### About Us Area Start ##### -->
     <section class="about-us-area mt-50 section-padding-100">
         <div class="container">
           <div class="contact-content">
             <div class="wow fadeInUp" data-wow-delay="500ms">
               <h2>Personal details</h2>
             </div>
               <div class="col-12">
                   <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                       <form action="#" onsubmit="return validation()" method="post">
                           <div class="form-label-group">
                             <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username">
                             <span id="errorUsername" class="error"><?php if($errorUsername !=""){echo $errorUsername;}?></span>
                             <label for="inputUsername">Username</label>
                           </div>

                           <div class="form-label-group">
                             <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
                             <span id="errorPassword" class="error"></span>
                             <label for="inputPassword">Password</label>
                           </div>

                           <div class="form-label-group">
                             <input type="password" id="inputConfirmPass" class="form-control" placeholder="Confirm Password" >
                             <span id="errorConfirmPass" class="error"></span>
                             <label for="inputConfirmPass"> Confirm Password</label>
                           </div>

                           <div class="form-label-group">
                             <input type="text" name="fullName" id="inputName" class="form-control" placeholder="Full Name">
                             <span id="errorName" class="error"></span>
                             <label for="inputName">Full Name</label>
                           </div>

                           <div class="form-label-group">
                             <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Address">
                             <span id="errorEmail" class="error"></span>
                             <label for="inputEmail">Email Address</label>
                           </div>


                           <div class="form-label-group">
                             <select id="selectIDType" name="idType" class="form-control">
                               <option value="type" disabled="" selected="">ID Type</option>
                               <option value="ic">IC</option>
                               <option value="passport">Passport</option>
                             </select>
                             <span id="errorIDType" class="error"></span>
                           </div>

                           <div class="form-label-group">
                             <input type="text" name="idNo" id="inputIDNo" class="form-control" placeholder="IDNo">
                             <span id="errorIDNo" class="error"></span>
                             <label for="inputIDNo">ID Number</label>
                           </div>


                           <div class="form-label-group">
                             <input type="text" name="mobileNo" id="inputMobile" class="form-control" placeholder="Mobile Number">
                             <span id="errorMobileNo" class="error"></span>
                             <label for="inputMobile">Mobile Number</label>
                           </div>

                           <div class="form-label-group">
                             <input type="date" name="date" id="inputDateOfBirth" class="form-control">
                             <span id="errorDate" class="error"></span>
                             <label for="inputDateOfBirth">Date of Birth</label>
                           </div>

                           <div>
                             <h2>Qualification</h2>
                           </div>

                           <div class="form-label-group">
                             <select id="selectQualification" name="qualification" class="form-control">
                               <option value="type" disabled="" selected="">Qualification</option>
                               <?php
                                      $getQualification = "SELECT qualificationID,qualificationName from qualification";
                                             $qualification = $conn->query($getQualification);
                                                    if($qualification->num_rows > 0){
                                                              while($row = $qualification->fetch_assoc()){
                                                                         echo "<option value='" .$row["qualificationID"] ."'>" .$row["qualificationName"] ."</option>";
                                                                               }
                                                                                    }
                               ?>
                               <!--option value="1">STPM</option>
                               <option value="2">A-Levels</option>
                               <option value="3">Australian Matriculation</option>
                               <option value="4">Canadian Pre-University</option>
                               <option value="5">Unified Examination Certificate (UEC)</option>
                               <option value="6">International Baccalaureate</option-->
                             </select>
                             <span id="errorQualification" class="error"></span>

                           </div>
						   <span id="viewBtn"><input type="button" class="btn academy-btn mt-30 btn-sm " onclick="viewGradeList()" value="View Grade List"></span>

                           <div id="row">
						   <div id="table">
						   <br>
                             <table class="table" id="result" name="result">
                               <thead>
                                 <tr>
                                   <th>Subject</th>
                                   <th>Score</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject1" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score1" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject2" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score2" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="subject3" name="subject[]" class="form-control" placeholder="Subject">
                                       <label for="subject">Subject</label>
                                     </div>
                                   </td>
                                   <td>
                                     <div class="form-label-group">
                                       <input type="text" id="score3" name="grade[]" class="form-control" placeholder="Grade">
                                       <label for="grade">Score</label>
                                     </div>
                                   </td>
                                 </tr>



                                 <tr><td><input type="button" class="btn academy-btn mt-30 btn-sm " onclick="addSubject()" value="Add Subject"></td></tr>
                               </tbody>

                             </table>
							 </div>
							 <div><span id="errorResult" class="error"><?php if($errorResult !=""){echo $errorResult;}?></span></div>

							 <div id="gradeList" class="gradeList">
							 <br>
	<?php
	$getGradeList = "SELECT qualificationName,gradeList from qualification";
    $gradeList = $conn->query($getGradeList);
    if($gradeList->num_rows > 0){
    while($row = $gradeList->fetch_assoc()){
	echo $row["qualificationName"]."<br>";
	echo $row["gradeList"]."<br><br>";}

    }
									/*echo "<script>";
									echo 'var qualification = document.getElementById("qualification");';
									echo "var value = qualification[qualification.selectedIndex].value;";
									echo 'qualification.onchange = function(){';
									echo 'if(value == "Q01"){';
									echo ' alert("got");';
									echo 'var list = document.getElementById("gradeList");';
									echo 'list.innerHTML = "<p>cde</p>";}';
									echo 'else{list.innerHTML = "<p>xyz</p>";}} ';
									echo "</script>";*/
								?>
							 </div>
                           </div>



                           <button class="btn academy-btn mt-30" type="submit">Sign up</button>
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
     <script>
     var count = 4;
     var table = document.getElementById("result");

     //add a row to enter subject and grade
     function addSubject(){
       var row = table.insertRow(count);
       var cell1 = row.insertCell(0);
       var cell2 = row.insertCell(1);
       cell1.innerHTML = "<div class='form-label-group'><input type='text' id='subject"+count+"' name='subject[]' class='form-control' placeholder='Subject'><label for='subject'>Subject</label></div>";
       cell2.innerHTML = "<div class='form-label-group'>" +
                                     "<input type='text' id='score"+count+"' name='grade[]' class='form-control' placeholder='Grade'>"+
                                     "<label for='grade'>Score</label></div>";
                                     count++;
                                   }

     </script>



	 <?php
		echo "<script>var username = document.getElementById('inputUsername');";
		echo "var fullName = document.getElementById('inputName');";
		echo "var email = document.getElementById('inputEmail');";
		echo "var idType = document.getElementById('selectIDType');";
		echo "var idNo = document.getElementById('inputIDNo');";
		echo "var mobileNo = document.getElementById('inputMobile');";
		echo "var date = document.getElementById('inputDateOfBirth');";
		echo "var qualification = document.getElementById('selectQualification');";
		echo "username.value ='". $save[0]."';";
		echo "fullName.value ='". $save[1]."';";
		echo "email.value ='". $save[2]."';";
		echo "idType.value ='". $save[3]."';";
		echo "idNo.value ='". $save[4]."';";
		echo "mobileNo.value ='". $save[5]."';";
		echo "date.value ='". $save[6]."';";
		echo "qualification.value ='". $save[7]."';";
		echo "</script>";
	 ?>
   <?php
   if($errorUsername != "" || $errorResult != ""){
		$subjectList = $_POST['subject'];
		$gradeList = $_POST['grade'];

		echo "<script>";


		for($i = 0;$i < sizeof($subjectList) ;$i++){
        $subject = $subjectList[$i];
        $score = $gradeList[$i];
		echo "var subject = document.getElementById('subject".($i+1)."');";
		echo "var score = document.getElementById('score".($i+1)."');";
		echo "subject.value = '".$subject."';";
		echo "score.value = '".$score."';";
      }
		echo "</script>";
   }
   ?>
     <script src="js/signup.js"></script>
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
