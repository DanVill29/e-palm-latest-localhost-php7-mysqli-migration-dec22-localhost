<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();

$quiz_id=0;
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];	

$quiz_id="Select Quiz ID listed below";

  		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//$showtestquiz==0;

if(isset($_GET['q']))
{
if($_GET['q']=='test')
{
$s2=$_GET['qid'];
//echo $s2;

$qf=$quizz->get_all_questions_quizz_array($instructor_id,$s2);
$array_name=$qf;
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$instructor_id;
$_SESSION['quiz_id']=$s2;



//timer
$_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.


$result3 = mysqli_query($conn,"SELECT * FROM quizz where quizz_id='$s2'");
$row = mysqli_fetch_array($result3);
$quiz_time=$row["quiz_time"];
$_SESSION['quiz_time']=$quiz_time;
 
 
$_SESSION['expire'] = $_SESSION['start'] + ($quiz_time * 60);
header("location:index.php");
}
}



if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}


if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
$readonly='readonly';
}
else
$readonly='';



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["quizz_id"]) && isset($_POST["answer"]) && isset($_POST["question"]))
{
if (!empty ( $_POST['quizz_id']) && trim($_POST['quizz_id'])!=='' &&
!empty ( $_POST['answer']) && trim($_POST['answer'])!==''
&&
!empty ( $_POST['question']) && trim($_POST['question'])!=='')
{
//echo 'hoy';
$s=$_POST['quizz_id'];
$q=$_POST['question'];
$a=$_POST['answer'];
//echo $s.$q.$a;

$quizz->add_question('1',$s,mysqli_real_escape_string($conn,$q),mysqli_real_escape_string($conn,$a));
 echo  '<div class="container">';
 echo '<br>';
				echo '<p>';
echo '<a href="?q=test&&qid='.$s.'" class="btn btn-primary btn-lg" role="button">';
echo 'Test the quiz!';
echo '</a>';
echo '</p>';
echo '</div>';

}



else
echo 'give your answer';
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

 
  
  </script></head>

  <body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
         <a class="navbar-brand" href="#"><img src="logo1.png" style="width:50px;height:30px"></img></a>
		  
		  <?php
		  $src="upload/newupload/Instructor$instructor_id.jpg";
		 //echo $src;
		  if (file_exists($src))
	{
		  echo '<a class="navbar-brand" href="upload.php">';
echo '<img alt="HTML5 Icon" src="upload/newupload/Instructor'.$instructor_id.'.jpg". class="img-responsive img-circle" style="width:100px;height:30px"/>';
echo '</a>';
}else
{

		 		  echo '<a class="navbar-brand" href="upload.php">';
echo 'Update profile picture';
echo '</a>';
}

       
?>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="instructor_portal.php">Instructor</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Other menu <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li>				<a href="add_quizz.php">
				Add quiz in a subject.
				</a></li>
                  <li>		<a href="add_questiontype2.php">
				Add new multiple choice question!
				</a></li>
								</a></li>
                       <li>		<a href="add_questiontype1.php">
				Add open-end question!
				</a></li>
				 <li>				<a href="edit_quiz.php">
				Edit quiz and scores.
				</a></li>
								 <li>				<a href='add_discussion.php?iid=<?php echo $instructor_id; ?>'>
				Add discussion
				</a></li>
				
				              <li>				<a href="add_grades.php">
				Add grades in a subject
				</a></li>
				
				
								</a></li>
                  <li>				<a href="student_enroll.php">
				Enroll a student.
				</a></li>
                </ul>
              </li>
			                <li><a href="?q=logout">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
   
      </nav>
    <div class="container">


	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Add open end question</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

		
        <label for="inputPassword" class="sr-only">Quiz number</label>
		
		  <!--
        <input type="text" id="inputPassword" <?php  echo $readonly;?>  class="form-control" placeholder="quizz_id" required name='quizz_id'

		value='<?php echo $quiz_id; 
		
		
		
		
		?>'
		>
		-->
		
				<select class="form-control" name="quizz_id">
		<?php
$quizz->show_allquizzid_indropdwon()
		?>
</select>
		
				 <br>
		

		<br>
		 
		         <label for="inputPassword" class="sr-only">Question</label>
				 <!--
        <input type="text" id="inputPassword" class="form-control" placeholder="question title" required name='question' value=''>
		-->
		<textarea rows="10" id="inputPassword" class="form-control" placeholder="question title" required name='question' value=''></textarea>
		
		 <br>
		 
		 		         <label for="inputPassword" class="sr-only">Answer</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="answer" required name='answer' value=''>
		 <br>
			
			<!--
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
		-->
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>


	<br>
		        				<br>
						<a class="btn btn-success" href="instructor_portal.php">
				Go back to home page!
				</a>
				<br>
					<br>
      </form>



	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

    
    
    </script>
  </body>
</html>