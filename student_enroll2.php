<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();

$err_msg="";



if ($_SERVER["REQUEST_METHOD"] == "POST")
{

//open end
if(isset($_POST["gender"]) 
&& isset($_POST["fname"]) && isset($_POST["lname"])
&& isset($_POST["age"]) && isset($_POST["address"])
&& isset($_POST["cellnumber"]) 
&& isset($_POST["email"]) 
&& isset($_POST["password"]) && isset($_POST["confirm_password"])
)
{
if($_POST["fname"]=='first name' ||$_POST["lname"]=='last name'
||$_POST["age"]=='age' ||$_POST["address"]=='address'
||$_POST["cellnumber"]=='cellnumber'|| $_POST["password"]=='password' ||$_POST["confirm_password"]=='confirm_password'
)
{
	$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Check the fields!'.'</div>';
}

//
else if($_POST["password"] <> $_POST["confirm_password"])
{
		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Mismatch password and confirm_password'.'</div>';

}

else if(!isset($_POST["gender"]))
{


		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Check the fields!'.'</div>';


}



else if(!is_numeric($_POST["age"]))
{

		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Age should be integer. Must be 16 years old and above.'.'</div>';
}

else if(!is_numeric($_POST["cellnumber"]))
{

		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Cellnumber should be integer.'.'</div>';
}


//OK--
else if (!empty ( $_POST['gender']) && trim($_POST['gender'])!=='' &&
!empty ( $_POST['fname']) && trim($_POST['fname'])!==''
&& !empty ( $_POST['lname']) && trim($_POST['lname'])!==''
&& !empty ( $_POST['age']) && trim($_POST['age'])!==''
&& !empty ( $_POST['address']) && trim($_POST['address'])!==''
&& !empty ( $_POST['cellnumber']) && trim($_POST['cellnumber'])!==''
//&& !empty ( $_POST['course']) && trim($_POST['course'])!==''
&& !empty ( $_POST['password']) && trim($_POST['password'])!==''
&& !empty ( $_POST['confirm_password']) && trim($_POST['confirm_password'])!==''
|| !empty ( $_POST['subject1']) || trim($_POST['subject1'])!==''
|| !empty ( $_POST['subject2']) || trim($_POST['subject2'])!==''
|| !empty ( $_POST['subject3']) || trim($_POST['subject3'])!==''
|| !empty ( $_POST['subject4']) || trim($_POST['subject4'])!==''
)
{

$gender=$_POST['gender'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$age=$_POST['age'];
$address=$_POST['address'];
$cellnumber=$_POST['cellnumber'];
$course="BS in Education (Major in English)";
$password=$_POST['password'];
$email=$_POST['email'];



//$q=$_POST['question'];
//$a=$_POST['answer'];
//echo $s.$q.$a;
//$quizz->add_question('1',$s,$q,$a);
//header("location:login_quizz.php");

//time stamp
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
//echo $date_modified;
$student_id2=$quizz->student_enroll2($gender,$fname,$lname,$age,$address,$cellnumber,$course,$password,$email,'1',$date_modified);
$_SESSION['login'] = true;
$_SESSION['student_id2']=$student_id2;	


header("location:enroll_thankyoupage.php?s=$student_id2");

}



else
		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Check the fields!'.'</div>';
}


//no answer
else
		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Check the fields!'.'</div>';

}


?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Landing Page - e-Palm</title>

    <!-- Bootstrap Core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
  <style type="text/css">
      /*  */
	  body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container 
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }
	  */
	  
	        .form-signin {
        max-width: 600px;
        padding: 10px 29px 29px;
        margin: 0 auto 10px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 0px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"]
	  .form-signin input[type="checkbox"]	  {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;



}

.intro-message {
    position: relative;
    padding-top: 6%;
    padding-bottom: 6%;
}

.intro-message > h1 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 4.5em;
}

.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color:rgb(155, 171, 173);
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
}


    </style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <a class="navbar-brand topnav" href="home.php"><img src="logo1.png" style="width:90px;height:30px"></img></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="home.php">OUR STORY</a>
                    </li>
                    <li>
                         <a class="page-scroll" href="#student">STUDENT</a>
                    </li>
                    <li>
                  <a class="page-scroll" href="#teacher">FACULTY</a>
                    </li>
					                    <li>
                              <a class="page-scroll" href="#blog">BLOG</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
		  <section id="enroll" class="enroll">
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
				 
		
	<form class="form-signin" role="form" method='post' action=''>

				<div class="intro-message" style="">
                        <h1>Enroll now!</h1>
						</div>
	<div class="btn-group" data-toggle="buttons">
                  <label for="'.$radio.'" class="btn btn-primary">
                    <input class="form-control" type="radio"  value="Male" name="gender">Male</button>
					</label>
					
					<label for="'.$radio.'" class="btn btn-primary">
                    <input class="form-control" type="radio"  value="Female" name="gender">Female</button>
        </label>
				  </div>
<br>
<br>

        <input type="text" id="inputPassword" class="form-control" placeholder="First Name" required name='fname' value=''>
		 <br>

        <input type="text" id="inputPassword" class="form-control" placeholder="Last Name" required name='lname' value=''>
		 <br>

        <input type="text" id="inputPassword" class="form-control" placeholder="Age" required name='age' value=''>
		 <br>
	

		         <input type="text" id="inputPassword" class="form-control" placeholder="Cellnumber" required name='cellnumber' value=''>
		 <br>
		 

			
					         <input type="text" id="inputPassword" class="form-control" placeholder="Permanent Address" required name='address' value=''>
		 <br>
		
		         <input type="email" id="inputPassword" class="form-control" placeholder="Email" required name='email' value=''>
		 <br>
		 <br>
		 
		 

			
					 					         <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password' value=''>
		 <br>
		 
		 		 					         <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required name='confirm password' value=''>
			
		
      
	  


								 <br>
								 <br>

								 								 <br>
								 <br>
								 <div class="well">
								<p class="lead">
								By clicking the Submit button below, I consent to representatives of e-Palm Online contacting me about EDUCATIONAL OPPORTUNITIES via email, text or phone including my mobile phone provided above. I understand that my consent is not a requirement for purchase.I understand that I may withdraw my consent at any time.
								<p>
						
								 </div>
							
								 								<?php						
								echo $err_msg;
								?>
								  <br>
								  <br>
				
        <button class="btn btn-lg btn-primary btn-block" type="submit">SUBMIT</button>

							<br>
		
    <p><a href="login_student.php" class="btn btn-success btn-block" role="button">Go to sign in page</a></p>

				<br>
				<br>

      </form>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
		</section>
    <!-- /.intro-header -->

    <!-- Page Content -->
	  <section id="student" class="student">
	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
               
					<hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                     <h2 class="section-heading">STUDENTS</h2>
					<h3 class="section-heading">Learning anytime and anywhere.</h3>
					 <p class="lead">Be informed. Enroll anywhere, anytime. Participate online discussions, exercises, quizzes, and exams.Keep track of your grades and your academic progress.</p><br>
                <p><a class="btn btn-default btn-lg" href="login_student.php">Click here to login »</a></p>
				
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="documents/epalm1.jpg" alt="">
                </div>
            </div>
							<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->

    </div>
	</section>
    <!-- /.content-section-a -->

	
	
		  <section id="teacher" class="teacher">
    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">FACULTY</h2>
					<h3 class="section-heading">Class management anytime and anywhere.</h3>
					  <p class="lead">Keep track of your classes.Create online discussions,exercises,quizzes,and exams.View your class list and submit grades.Add assessments.</p><br>
                <p><a class="btn btn-default btn-lg" href="login_instructor.php">Click here to login »</a></p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="documents/epalm2.jpg" alt="">
                </div>
            </div>
				<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->
		
					

    </div>
		</section>

    <!-- /.content-section-b -->

	
			  <section id="blog" class="blog">
    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Blog</h2>
                    <p class="lead">Stories, announcements, and news are posted here</p>
						   <p><a  target="_blank" class="btn btn-default btn-lg" href="http://epalm-online.blogspot.com/">Our blog page »</a></p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="documents/epalm3.jpg" alt="">
                </div>
				

            </div>
							<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->

    </div>
	</section>
    <!-- /.content-section-a -->

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect now to e-Palm:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="mailto:jauisland@gmail.com" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">gmail</span></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/pages/E-Palm-Online/339954186176836" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
			
		

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
<div class="col-lg-12 footer-below">
               <p><a href="#">e-Palm Online</a> is a project maintained by <a href="#">e-Palm Inc</a>.
			   <br>
			   This has been currently pilot-tested by the online education program of <a href="#">Raise a Village Project Organization Inc.</a>
			</p>
 
            </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="dist/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script>
	
		    <!-- Scrolling Nav JavaScript -->
    <script src="dist/js/jquery.easing.min.js"></script>
    <script src="dist/js/scrolling-nav.js"></script>

</body>

</html>
