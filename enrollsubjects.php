<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg='';


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$year_level=1;
$subject1="";
$subject2="";
$subject3="";
$subject4="";
$subject5="";
$subject6="";
$subject7="";
$subject8="";




if(isset($_SESSION['student_id']) && isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
//echo $student_id;
$password=$_SESSION['password'];
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn,"SELECT * FROM student WHERE student_id='$student_id' and password='$password'");
$user_data = mysqli_fetch_array($result);
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

if(isset($_GET['gotoquiz']))
{
$qid=$_GET['gotoquiz'];
$_SESSION['student_id']=$student_id;
header("location:quizpage.php?subject=$qid");
}


if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_student.php");
}
}

$err_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

if(!empty($_POST['subject'])) {
// Counting number of checked checkboxes.
$checked_count = count($_POST['subject']);
echo "You have selected following ".$checked_count." option(s): <br/>";
// Loop to store and display values of individual checked checkbox.


//$id_array=array();
foreach($_POST['subject'] as $selected) {
//echo "<p>".$selected ."</p>";

//time stamp
//date_default_timezone_set("Asia/Manila");
//$d=time();
//$date_modified=date("Y-m-d h:i:sa", $d);
//echo $date_modified;
//$quizz->enroll_subjects($student_id,$year_level,$subject1,$subject2,$subject3,$subject4,$date_modified);

//$quizz->enroll_subjects($student_id,$year_level,$subject1,$subject2,$subject3,$subject4);


$quizz->enroll_subjects($student_id,$year_level,$selected);
}

}

else
		$err_msg='<div class="alert alert-danger" role="alert">'.'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">'.'</span>'.
  '<span class="sr-only">'.'Error:'.'</span>'.
  'Select at least one subject!'.'</div>';




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

      </style>
  
  
  </head>

  <body>



    <div class="container">
	
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
<br>
    <div class="container-fluid">
	
	<div class="panel panel-default">
                
                    <div class="panel-body">
                      <form class="form-signin" role="form" method='post' action=''>

				
	<br>
								 <br>
								
								 <label>
								 <h4>Available Subjects</h4>
								  </label>
								  <hr>
								  
							
								 <?php
								 $quizz->show_allsubjects($year_level);
								 
								
								 
								 
								 
								 
								 ?>
								 <?php						
								echo $err_msg;
								?>
								  <br>
								 
				
        <button class="btn btn-lg btn-primary btn-block" type="submit">SUBMIT</button>

				<br>
						
								 								 <br>


								 
							
								 								

      </form>
              
			  	  	 <div class="well">
	  
	  <?php
	   echo '<hr>';
								 echo '<br>';
								 $quizz->show_allsubjects_enrolled($year_level,$student_id);
	  
	  ?>
	  </div>
			  
			  
                    </div><!--/panel-body-->
                 </div><!--/panel-->
				 


<div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
				 
		
	

	  
	  
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
<!--
        <div class="panel panel-primary">
            <div class="panel-heading">
						
              <h3 class="panel-title"><a href="subject1.php?subject=1"><strong>PROF ED 2: Facilitating Learning</strong></a></h3>
			
            </div>
            <div class="panel-body">
               <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		  
		  
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=2"><strong>STRAT 4: Principles of Teaching 1</strong></a></h3>
            </div>
            <div class="panel-body">
                     <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=3"><strong>STRAT 5: Developmental Training 1</strong></a></h3>
            </div>
            <div class="panel-body">
                       <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=4"><strong>ECON 1: Basic Economics Taxation, Agrarian Reform</strong></a></h3>
            </div>
            <div class="panel-body">
                         <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  

-->





	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>