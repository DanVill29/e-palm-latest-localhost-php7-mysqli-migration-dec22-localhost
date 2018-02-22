<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];	
$quiz_id="Select Quiz ID listed below";

  		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
$readonly='readonly';
}
else
$readonly='';


if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["quizz_id"]) && isset($_POST["answer"]) && isset($_POST["question"]))
{
if($_POST["student_id"]=='quizz_id' ||$_POST["quizz_id"]=='answer' ||$_POST["question"]=='question')
{
echo 'give your answer';
}
else if (!empty ( $_POST['quizz_id']) && trim($_POST['quizz_id'])!=='' &&
!empty ( $_POST['answer']) && trim($_POST['answer'])!==''
&&
!empty ( $_POST['question']) && trim($_POST['question'])!=='')
{
//echo 'hoy';
$s=$_POST['quizz_id'];
$q=$_POST['question'];
$a=$_POST['answer'];
//echo $s.$q.$a;
$q_id=$quizz->add_question('2',mysqli_real_escape_string($conn,$s),mysqli_real_escape_string($conn,$q),mysqli_real_escape_string($conn,$a));
$_SESSION['login'] = true;
$_SESSION['quizz_id']=$s;
$_SESSION['question']=$q;
$_SESSION['answer']=$a;
$_SESSION['question_id']=$q_id;

header("location:add_questiontype2_addmore.php");

/*
mysqli_query("INSERT INTO question(question_id,title,question_type_id,quizz_id) values ('','$q','1','$s')") or die(mysqli_error());

$result = mysqli_query("SELECT * FROM question WHERE quizz_id=$s order by question_id desc");
$count=mysqli_num_rows($result);
if($count>0)
{
$user_data = mysqli_fetch_array($result);
$question_id= $user_data['question_id'];
mysqli_query("INSERT INTO question_values1(question_id,value,answer) values ('$question_id','$q','$a')") or die(mysqli_error());
}
*/

//$qf=$quizz->get_all_questions_quizz_array($s,$q);
//$array_name=$qf;

//$_SESSION['login'] = true;
//$_SESSION['array_name']=$array_name;	


//echo $qf;
//$quizz->save_qset($qf,$s,$q,$value);
//header("location:index.php?s=$s&&q=$q");
/*
foreach ($array_name as $value) {
echo $value;
//mysqli_query("INSERT INTO qset(qset_id,student_id,quizz_id,question_id) values ('','$s','$q','$value')") or die(mysqli_error());
}
*/
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
        <h2 class="form-signin-heading">Add multiple choice question</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

				<select class="form-control" name="quizz_id">
		<?php
$quizz->show_allquizzid_indropdwon()
		?>
</select>
		 <br>
		         <label for="inputPassword" class="sr-only">Question</label>
				 <!--
        <input type="text" id="inputPassword" class="form-control" placeholder="question title" required name='question' value=''>
		
		-->
		<textarea rows ="10" id="inputPassword" class="form-control" placeholder="question title" required name='question' value=''></textarea>
		
		 <br>
	
		 		         <label for="inputPassword" class="sr-only">Answer</label>
        <input type="text" row="40" id="inputPassword" class="form-control" placeholder="correct answer" required name='answer' value=''>
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