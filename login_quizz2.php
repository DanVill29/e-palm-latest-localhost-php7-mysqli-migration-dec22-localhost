<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg='';

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');


$year_level=1;

//timer
$now = time(); // Checking the time now when home page starts.
if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:login_student.php");
        }



if(isset($_SESSION['student_id']) && isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
$password=$_SESSION['password'];

//
$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result3 = mysqli_query($conn,"SELECT * FROM student where student_id='$student_id'");
$row = mysqli_fetch_array($result3,MYSQLI_ASSOC);

$fullname=$row["firstname"]." ".$row["lastname"];
//echo $fullname;
$result = mysqli_query($conn,"SELECT * FROM student WHERE student_id='$student_id' and password='$password'");
$user_data = mysqli_fetch_array($result,MYSQLI_ASSOC);
$year_level= $user_data['year_level'];
echo $year_level;

}

if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
}


if(!$quizz->check_student_exist($student_id))
{
$_SESSION['login'] = FALSE;
$err_msg='Login id did not exists!';
}

	

if(!isset($_SESSION['login']))
{
$_SESSION['login'] = FALSE;
}

if (!$quizz->get_session())
{
header("location:login_student.php");
}

if(!$quizz->check_student_exist2($student_id,$password))
{
$_SESSION['login'] = FALSE;
$err_msg='Login id did not exists!';
}



if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_student.php");
}
}

if(isset($_GET['gotoquiz']))
{
$qid=$_GET['gotoquiz'];
$_SESSION['student_id']=$student_id;
header("location:quizpage.php?subject=$qid");
}





if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["student_id"]) && isset($_POST["quizz_id"]))
{

if (!empty ( $_POST['student_id']) && trim($_POST['student_id'])!=='' &&
!empty ( $_POST['quizz_id']) && trim($_POST['quizz_id'])!=='')
{
$s=$_POST['student_id'];
$q=$_POST['quizz_id'];
echo $q.$s;

if(!$quizz->check_student_exist($s))
{
$err_msg='Student id did not exists!';
}
else
{
//echo 'wah!';
$qf=$quizz->get_all_questions_quizz_array($student_id,$q);
$array_name=$qf;


/*
*/
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$s;
$_SESSION['quiz_id']=$q;
header("location:index.php");


}

}


else
echo 'give your answer';
}
else
echo 'give your answer';




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
    
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
    
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

      </style>
  
  </head>

  <body>
  <br>
    <br>
  
<div class="page-container">
  
	<!-- top navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="logo1.png" style="width:40px;height:30px"></img></a>
		  
		  <?php
		  $src="upload/newupload/$student_id.jpg";
		 // echo $src;
		  if (file_exists($src))
	{
		  echo '<a class="navbar-brand" href="upload.php">';
echo '<img alt="HTML5 Icon" src="upload/newupload/'.$student_id.'.jpg". class="img-responsive img-circle" style="width:100px;height:30px"/>';
echo '</a>';
}else
{

		 		  echo '<a class="navbar-brand" href="upload.php">';
echo '<small>';
				  echo 'Update profile picture';
				  echo '</small>';
echo '</a>';
}

       
?>

	   </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="login_quizz2.php">Student</a></li>
			<li ><a href="enrollsubjects.php">Enroll subjects</a></li>
			<li ><a href="grades.php">Grades</a></li>
            <li><a href="?q=logout">Logout</a></li>
		
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      
    <div class="container-fluid">

      
	


          <div class="row">
		   	 <div class="col-sm-1">
			 
			 </div>
           	 <div class="col-sm-6">
       
             
				                 <div class="panel panel-default">
                   <div class="panel-heading"> <h4>Welcome to e-Palm Online!</h4></div>
                    <div class="panel-body">
                      <p><img style="width:150px;height:100px" class="img-circle pull-right" src="documents/good-study-habits.png"> 
					  
					  
					  
					  
					  <a href="#">    <h4 class="page-title"><?php echo $fullname; ?></h4></a></p>
                      <div class="clearfix"></div>
                      <hr>
                      Make sure that you're up to date to the quizzes and discussions.Check the modules and lessons in the subject page.
					  Check also our video tutorials. Make sure also that you have the copies of all materials needed.These are also available in our download section.
					  <br>
					   <br>
					  For your notification, email will be sent once a new quiz is being added by your instructor. Please make sure to
					  answer it correctly. Be aware also of the time limits. Anytime, your instructor will give feedback and assessment based on your performance.
                        <br>
					   <br>
					  Start now! 
					  <hr>
              
                    </div><!--/panel-body-->
                 </div><!--/panel-->
				 
				 
				 <div class="panel panel-default">
                   <div class="panel-heading"><a href="enrollsubjects.php" class="pull-right">View all</a><h4>Faculty Staff</h4></div>
                    <div class="panel-body">
                      <p><img style="width:150px;height:100px" class="img-circle pull-right" src="documents/61474_10201442469285738_1763299897_n.jpg"> 
					  
					  
					  
					  
					  <a href="#">    <h4 class="page-title">Juanito Cristobal Jr.</h4></a></p>
                      <div class="clearfix"></div>
                      <hr>
                   eLearning Administrator
RAVPO
March 2011 – Present (4 years 2 months)Philippines
                      <hr>
					  
					  <hr>
College Online Program Administrator
Raise a Village Project Organization, Inc.
February 2012 – Present (3 years 3 months)
Tutor, Program Developer
                      <hr>
					  <hr>
					  Ecotourism Assistant
Department of Environment and Natural Resources - 7
February 2012 – Present (3 years 3 months)National Government Center, Sudlon, Lahug, Cebu City
              <hr>
			  
			  
			    <hr>
University of San Jose - Recoletos
Master of Arts, Philosophy
2006 – 2012
              <hr>
			  
			  
			    <hr>
				University of San Jose - Recoletos
Bachelor of Arts, Philosophy
2000 – 2004
              <hr>
			  
			  
			  
                    </div><!--/panel-body-->
                 </div><!--/panel-->
             
             

            </div><!--/col-->
			
			
            
            <div class="col-sm-4">
			         <div class="panel panel-default">
                  <div class="panel-heading"><a href="enrollsubjects.php" class="pull-right">View all</a> <h4>Subjects</h4></div>
				  <div class="panel-body">
                      <div class="list-group">
         						<?php
	   echo '<hr>';
								 echo '<br>';
								 $quizz->show_allsubjects_enrolled($year_level,$student_id);
	  
	  ?>

                      </div>
					  

					  
					  
					  
                    </div><!--/panel-body-->
   
                </div><!--/panel-->
			
			             <div class="panel panel-default">
                   <div class="panel-heading"> <h4>Grades</h4></div>
                    <div class="panel-body">
       
                      <hr>
                      Always monitor your grades.<a href="grades.php"> Click here!</h4></a>.   
                      <hr>
              
                    </div><!--/panel-body-->
                 </div><!--/panel-->    


        
              </div><!--/col-->
			  
			  
			                   	   	 <div class="col-sm-5">
			 
			 </div>
				 
			  
          </div><!--/row-->
          

  

              

          	<div class="clearfix"></div>
      
          

      </div><!--/.row-->

  </div><!--/.container-->
  
  
  
  


  
</div><!--/.page-container-->
  

  <br>
   <br>
   <hr>
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>
        