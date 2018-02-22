<?php
session_start();
ob_start();

include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg='';

if(!isset($_SESSION['login']))
{
$_SESSION['login'] = FALSE;
}

if(isset($_SESSION['instructor_id']) &&isset($_SESSION['password']))
{
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];
}

if ($quizz->get_session())
{
header("location:instructor_portal.php");
}





if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["instructor_id"]) && isset($_POST["password"]))
{

if (!empty ( $_POST['instructor_id']) && trim($_POST['instructor_id'])!=='' &&
!empty ( $_POST['password']) && trim($_POST['password'])!=='')
{
//echo 'hoy';
$i=$_POST['instructor_id'];
$p=$_POST['password'];
//echo $s.$q;

if(!$quizz->check_instructor_exist($i,$p))
{
$err_msg='Login id did not exists!';
}
else
{

$_SESSION['login'] = true;
$_SESSION['instructor_id']=$i;	
$_SESSION['password']=$p;	

//timer
 $_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.
 $_SESSION['expire'] = $_SESSION['start'] + (20 * 60);


header("location:instructor_portal.php?ep=$i");
}

}



else
echo 'give your answer';
}


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
    <link rel="icon" href="../../favicon.ico">

    <title>e-Palm</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }
	  
	        .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
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
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;


}


    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button >
       <a class="navbar-brand" href="home.php"><img src="logo1.png" style="width:90px;height:30px"></img></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="login_student.php">Student</a></li>
            <li class="active"><a href="login_instructor.php">Faculty</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<br>
<br>
		
		
		  
	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Faculty Login</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->
        <label for="inputPassword" class="sr-only">Quiz number</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Instructor id" required name='instructor_id' value=''>
	
				
        <label for="inputPassword" class="sr-only">Quiz Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password' value=''>

					
								<?php						
								echo $err_msg;
								?>
			
			
			<!--
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
		-->
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>


      </form>

	  <div class="row">
	  
	
				 
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Student</h4>
                  <p>Be informed. Enroll anywhere, anytime. Participate online discussions, exercises, quizzes, and exams.Keep track of your grades and your academic progress.</p>
          <p><a class="btn" href="login_student.php">Click here to login »</a></p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
					     <div class="team-member">
						 
						 
						 
						 </div>
					
                </div>
				
	
				
				
                            <div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Faculty</h4>
          <p>Keep track of your classes. Create online discussions, exercises, quizzes, and exams. View your class list and submit grades. Add assessments.</p>
          <p><a class="btn" href="login_instructor.php">Click here to login »</a></p>

                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
				
				<div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm3.jpg" class="img-responsive img-circle" alt="">
<br>                      
					  <h4>Our Story</h4>
          <p>Stories, announcements, and news are posted here</p>
		  <br> 
		  <br> 
          <p><a class="btn" href="http://epalm-online.blogspot.com/" target="_blank">Click here to see our blog page »</a></p>

                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
				
				
	
		
				</div>
				
				  <br>
	  <br>	
				

            <p>If you have general feedback, or if you have an idea or inquiries, please email us at:</p>
            <p><strong><a href="mailto:jauisland@gmail.com">question@e-palm.net</a></strong></p>
	
				
				  
	  <br>
	  <br>

  	  	  <br>
	  <br>
	  <footer>

        <hr>
        <div class="row">
            <div class="col-lg-12 footer-below">
               <p><a href="#">e-Palm Online</a> is a project maintained by <a href="#">e-Palm Inc</a>.
			   <br>
			   This has been currently pilot-tested by the online education program of <a href="#">Raise a Village Project Inc.</a>
			</p>
 
            </div>
        </div>

</footer>
	  

    </div><!-- /.container -->

	


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>