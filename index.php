<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
$quizz = new quizz_engine();
$error_msg='';

//echo $s;
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



//timer
$now = time(); // Checking the time now when home page starts.
if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:login_student.php");
        }



if(isset($_SESSION['array_name']))
{
$array_name=$_SESSION['array_name'];
}


if(isset($_SESSION['quiz_time']))
{
$quiz_time=$_SESSION['quiz_time'];
//echo $quiz_time;
}



if(isset($_SESSION['instructor_id']) && isset($_SESSION['password']))
{
$student_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];	
}

if(isset($_SESSION['student_id']))
{
$student_id=$_SESSION['student_id'];
}

if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
}



if(!isset($array_name))
{
header("location:login_quizz.php");
}

if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
session_destroy();
header("location:login_student.php");
}
}


//$question_id=$quizz->get_all_questions_final($array_name,$student_id,$quiz_id);
echo '<br>';
echo '<br>';

echo '';
echo '<div class="container">';
echo '<div class="panel panel-primary">';

echo '<div class="panel-heading">';
echo '<h3 class="panel-title">';
/*echo 'Question set:';
foreach ($array_name as $value) {
echo $value;
echo ',';
}
*/
echo 'You only have '.$quiz_time.' minute/s to complete this.';
echo '<br>';
echo 'Make sure to answer all questions in this period of time.';
echo '</h3>';
echo '</div>';          
						
              
			
            


echo '<div class="panel-body">';
        
//
echo '<p class="lead">';



$question_id=$quizz->get_all_questions_final($array_name,$student_id,$quiz_id);
if($question_id)
{
echo '<br>';
$question_type_id=$quizz->get_question_type_id($question_id);
$quizz->get_questionvalue($question_id,$question_type_id);

}
//echo $error_msg;






			
           













if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["answer"]))
{
if (!empty ( $_POST['answer']) && trim($_POST['answer'])!=='')
{
//echo $_POST["answer"];
//echo $quiz_id;
//echo $student_id;
$quizz->check_answer(mysqli_real_escape_string($conn,$_POST["answer"]),$question_id,'1',$student_id,$quiz_id);
}
else
echo 'give answer';
}


//radio button
else if(isset($_POST["quizz"]) )
{
//echo $quiz_id;
//echo $student_id;
//echo $_POST["quizz"];
$quizz->check_answer(mysqli_real_escape_string($conn,$_POST["quizz"]),$question_id,'2',$student_id,$quiz_id);
}

//no answer
else
echo 'give answer';

}


ob_end_flush();

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




    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="logo1.png" style="width:50px;height:30px"></img></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="#">Student</a></li>
            <li class="active"><a href="?q=logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


		  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>


	
	

	
	
	
 </body>
 <?php
 echo '</p>';

//

echo '</div>';

echo '</div>';
echo '</div>';
 ?>