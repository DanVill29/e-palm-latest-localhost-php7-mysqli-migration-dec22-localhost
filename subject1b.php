<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg=' ';
$subject='';


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");




if(isset($_SESSION['student_id']) || isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
$password=$_SESSION['password'];
}

if(isset($_SESSION['subject']))
{
$subject=$_SESSION['subject'];
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

if(isset($_GET['addcom']) && isset($_GET['subject']))
{
if($_GET['addcom']=='1')
{
$_SESSION['student_id']=$student_id;
$_SESSION['subject']=$_GET['subject'];
header("location:add_discussion_s.php");
}
}

if(isset($_GET['gotoquiz']))
{
$subject=$_GET['gotoquiz'];
$_SESSION['student_id']=$student_id;
header("location:quizpage.php?subject=$subject");
}




if(isset($_GET['subject']))
{
$subject=$_GET['subject'];
	
}


//for retest
if(isset($_GET['retest']))
{
$quiz_id=$_GET['retest'];
//reset scores and answers
$quizz->retest($student_id,$quiz_id);
//$quiz_id=$_POST["submit"];
$qf=$quizz->get_all_questions_quizz_array($student_id,$quiz_id);
$array_name=$qf;
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$student_id;
$_SESSION['quiz_id']=$quiz_id;



//timer
$_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.
 
$result3 = mysql_query("SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysql_fetch_array($result3);
$quiz_time=$row["quiz_time"];
$_SESSION['quiz_time']=$quiz_time;
 
 
$_SESSION['expire'] = $_SESSION['start'] + ($quiz_time * 60);
header("location:index.php");
}








if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//echo hoy;
if(isset($_POST["submit"]))
{
if(!$quizz->check_student_exist($student_id))
{
$err_msg='Student id did not exists!';
}
else
{
$quiz_id=$_POST["submit"];
//echo $quiz_id;
$qf=$quizz->get_all_questions_quizz_array($student_id,$quiz_id);
$array_name=$qf;

$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$student_id;
$_SESSION['quiz_id']=$quiz_id;

//timer
$_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.
 
$result3 = mysql_query("SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysql_fetch_array($result3);
$quiz_time=$row["quiz_time"];
$_SESSION['quiz_time']=$quiz_time;
 
 
$_SESSION['expire'] = $_SESSION['start'] + ($quiz_time * 60);
header("location:index.php");
}
}


else
$err_msg='This quiz is not yet applicable. Answer the other quiz first. Take quiz in ascending manner.';

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
	


  
  
  </head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
             <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="login_quizz2.php"><img src="logo1.png" style="width:50px;height:30px"></img></a>
			
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
echo 'Update profile picture';
echo '</a>';
}

       
?>
			
			
			
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="login_quizz2.php">Student</a></li>
						                   <li class="">
                        <a class="page-scroll" href="#about">About the Subject</a>
                    </li>
			
				                   <li class="">
                        <a class="page-scroll" href="#lessons">Lessons and Discussions</a>
                    </li>
    
			
			
			                   <li class="">
                        <a class="page-scroll" href="#quiz">Exercise/Quiz/Exam</a>
                    </li>
    
	
	
			
            <li class=""><a href="?q=logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	  
	  
	  
	  
	
	  
    </nav>

<br>
<?php

if($subject==1)
{
include_once("subject1_info.php");
}
else if($subject==2)
{
include_once("subject2_info.php");
}
else if($subject==3)
{
include_once("subject3_info.php");
}
else if($subject==4)
{
include_once("subject4_info.php");
}

else if($subject==5)
{
include_once("subject5_info.php");
}
else if($subject==6)
{
include_once("subject6_info.php");
}
else if($subject==7)
{
include_once("subject7_info.php");
}
else if($subject==8)
{
include_once("subject8_info.php");
}


else
echo 'Subject info is not yet ready!';


?>
	

	
	
    <!-- jQuery 
    <script src="dist/js/jquery.js"></script>
	-->

    <!-- Bootstrap Core JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="dist/js/jquery.easing.min.js"></script>
    <script src="dist/js/scrolling-nav.js"></script>

  </body>
</html>

