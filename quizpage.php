<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg=' ';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if(isset($_SESSION['student_id']) || isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
$password=$_SESSION['password'];
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

if(isset($_GET['addcom']))
{
if($_GET['addcom']=='1')
{
$_SESSION['student_id']=$student_id;
header("location:add_discussion_s.php");
}
}

if(isset($_GET['gotoquiz']))
{
if($_GET['gotoquiz=1']=='1')
{
$_SESSION['student_id']=$student_id;
header("location:add_discussion_s.php");
}
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
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result3 = mysqli_query($conn,"SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysqli_fetch_array($result3);
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
 
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result3 = mysqli_query($conn,"SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysqli_fetch_array($result3);
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
            <li class="">
			<?php
			echo '<a href="subject1b.php?subject='.$subject.'">';
			echo 'Go back to Subject page';
			echo '</a>';
				?>
			</li>
		
						                   
			                   <li class="active">
                        <a class="page-scroll" href="#quiz">Exercise/Quiz/Exam</a>
                    </li>
    
	
			
			
            <li class=""><a href="?q=logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	  
	  
	  
	  
	
	  
    </nav>



<!-- Subejct-->


<!-- Quizzes-->
<br>
  <section id="quiz" class="quiz">
    <div class="container">
	

    <div class="panel-group" id="accordion">
			  
		          <div class="panel panel-primary">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>Exercises, Quizzes, and Exams</strong></a></h3>
			
            </div>
		            <div class="panel-body">
					
					
					         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOneQ"></a>
          </strong>
            </div>
            <div id="collapseOneQ" class="panel-collapse collapse in">
                <div class="panel-body">
		<p class="lead">Your progress</p>
		<div class="progress progress-striped">
    <div class="progress-bar progress-bar-warning" style="width:<?php
$width=$quizz->progresbar_byquiz($student_id);echo $width."%".";";?>">
        <span class="sr-only">10% Complete</span>
    </div>
</div>	
<?php
$width=$quizz->progresbar_byquiz($student_id);
echo "<p class='lead'>";
echo "$width";
echo "%";

echo " completed quizzes and exams.";
echo "</p>";
?>	
	<hr>
	

	
<section id="done" class="done">
<br>
<p class="lead">
I. Already taken quizzes/exams/exercises:
</p>
 
			
<a class="page-scroll" href="#Available">Go to Available quizzes/exercise/exams</a>





			  <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading"></h2>

	<?php	
		/*checking and getting quiz by student and subject */
		$quizz->show_quizzes($subject,$student_id);

?>

		
	<!--	
        <button class="btn btn-lg btn-primary btn-block" name="submit" value='<?php echo $quiz_id; ?>' type="submit">Quizz 1</button>
-->

      </form>
				
				
           
            </div>
			</div>
        </div>
					
					
					

		 
            </div>		  
	
	

		
		</div>
    </div>
		  		<a class="btn btn-default page-scroll" href="#quiz">Back to Top</a>
<br>
<br>

</section>




	
	
	

    </div><!-- /.container -->

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script>
    $('#link').click(function () {
    //    var src = src='//www.youtube.com/embed/Q-_m6rEj8Y4"?badge=0&amp;autoplay=1&amp;html5=1';
        $('#myModal').modal('show');
      //  $('#myModal iframe').attr('src', src);
    });
/*
$('#myModal').on('hidden.bs.modal', function () {
    $('#myModal iframe').removeAttr('src');
})*/
</script>

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

