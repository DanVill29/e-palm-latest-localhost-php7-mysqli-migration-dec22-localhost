<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$subject='';
$iid=0;
$editdisc=0;
//echo $subject;


if(isset($_SESSION['student_id']) && isset($_SESSION['password']))
{
$instructor_id=$_SESSION['student_id'];
$password=$_SESSION['password'];	
}




if(isset($_GET['iid']))
{
$iid=$_GET['iid'];
//echo $iid;
}

if(isset($_GET['subject']))
{
$subject=$_GET['subject'];
$_SESSION['subject']=$subject;
//echo $iid;
}



if(isset($_GET['editdisc']))
{
$editdisc=$_GET['editdisc'];
//echo $editdisc;

$_SESSION['editdisc']=$editdisc;
$_SESSION['instructor_id']=$instructor_id;
header("location:add_comment_s.php");
}

if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}



if(isset($_GET['subject']))
{
if($_GET['subject'] <> '')
{
$subject=$_GET['subject'];
}
}


if(isset($_SESSION['subject']))
{

$subject=$_SESSION['subject'];

}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["discussion"]) && isset($_POST["subject"]))
{
//echo 'hoy';
$s=$_POST['subject'];
$n=$_POST['discussion'];


//echo $s.$n;
$quizz->add_discussion($s,$n,$iid);
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result3 = mysqli_query($conn,"SELECT * FROM discussion order by id desc");
$row = mysqli_fetch_array($result3);
$subject=$row["subject"];

//$quiz_id=$quizz->add_quiz($s,$n,$quiztype);
//$_SESSION['login'] = true;
//$_SESSION['quiz_id']=$quiz_id;	
//header("location:add_discussion.php");

}

//no answer
else
echo 'give answer';

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
    <link rel="apple-touch-icon" href="//mindmup.s3.amazonaws.com/lib/img/apple-touch-icon.png" />
    <link rel="shortcut icon" href="http://mindmup.s3.amazonaws.com/lib/img/favicon.ico" >
    <link href="bootstrap-wysiwyg-master/bootstrap-wysiwyg-master/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="bootstrap-wysiwyg-master/bootstrap-wysiwyg-master/external/jquery.hotkeys.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="bootstrap-wysiwyg-master/bootstrap-wysiwyg-master/external/google-code-prettify/prettify.js"></script>

		<link href="bootstrap-wysiwyg-master/bootstrap-wysiwyg-master/index.css" rel="stylesheet">
    <script src="bootstrap-wysiwyg-master/bootstrap-wysiwyg-master/bootstrap-wysiwyg.js"></script>
  
  </head>

  <body>

    <div class="container">


    <p><a href="subject1b.php" class="btn btn-primary btn-block" role="button">Back to home page</a></p>

		  

	  
	  
	  			
<div class="well well-large">
   	  		<?php
$quizz->show_alldiscussion_inasubject($subject,$iid);
		?>
</div>
	
	  



		




	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>