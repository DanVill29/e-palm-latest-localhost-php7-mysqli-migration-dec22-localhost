<?php
session_start();
//$_SESSION['array_name']=$array_name;
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$editnumid="";
$name="";
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];
$q="";
$a="";
$s="";
$question_id="";

if(isset($_SESSION['quizz_id']))
{
$q=$_SESSION['quizz_id'];
//echo $q;
}
//$_SESSION['editnumid']=$editnumid;
if(isset($_SESSION['editnumid']) && isset($_SESSION['name']))
{
$editnumid=$_SESSION['editnumid'];
$name=$_SESSION['name'];
//echo $editnumid.$name;
}





if(isset($_SESSION['question_id']))
{
$question_id=$_SESSION['question_id'];
//echo $question_id;
//$q_id=$_SESSION['question_id'];
$s=$_SESSION['question'];
$a=$_SESSION['answer'];
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];	
}


if(isset($_SESSION['quizz_id']))
{
$q=$_SESSION['quizz_id'];
//echo $q;
}








if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}

if(isset($_GET['q']))
{
if($_GET['q']=='test')
{
$qf=$quizz->get_all_questions_quizz_array($instructor_id,$q);
$array_name=$qf;
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$instructor_id;
$_SESSION['quiz_id']=$q;
header("location:index.php");
}

}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["choice"]) && isset($_POST["choice"]) && isset($_POST["choice"]))
{
if($_POST["choice"]=='choice' ||$_POST["quizz_id"]=='choice' ||$_POST["question"]=='choice')
{
echo 'give your answer';
}
else if (!empty ( $_POST['choice']) && trim($_POST['choice'])!=='' &&
!empty ( $_POST['choice']) && trim($_POST['choice'])!==''
&&
!empty ( $_POST['choice']) && trim($_POST['choice'])!=='')
{
$c=$_POST['choice'];


//echo $s.$q.$a;


$quizz->update_multiplechoice($c,$editnumid);
//$quizz->add_question('choice',$question_id,$q,$c);
header("location:edit_quiz2.php");
}

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
    <link rel="icon" href="../../favicon.ico">

    <title>e-Palm</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


  
  
  </head>

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

	  <br>
	    <br>
		  <br>
	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Update multiple choice</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

		 
		         <label for="inputPassword" class="sr-only">Choice</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Add more choice/s" required name='choice' value='<?php echo $name;	
		?>'>
		 <br>
		 

			<!--
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
		-->
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
		        				<br>
								
				    <p>Quiz ID you currently edited: <?php  echo $q; ?></p>


					    <p>Question ID you currently edited: <?php  echo $question_id; ?></p>


						    <p>Question name: <?php  echo $s ?></p>
							
													    <p>Answer for this question: <?php  echo $a ?></p>

				

					    <p><a href="?q=test" class="btn btn-primary btn-lg" role="button">Test the quiz!</a></p>

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

  </body>
</html>