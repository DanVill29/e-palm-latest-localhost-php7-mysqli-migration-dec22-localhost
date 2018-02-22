<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if(isset($_SESSION['instructor_id']) && isset($_SESSION['password']))
{
$instructor_id=$_SESSION['instructor_id'];
//echo $instructor_id;
$password=$_SESSION['password'];	


//
$result3 = mysqli_query($conn,"SELECT * FROM instructor where id='$instructor_id'");
$row = mysqli_fetch_array($result3);
$fullname=$row["name"];
}



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
if(isset($_POST["subject"]) && isset($_POST["name"]) && isset($_POST["quiz_time"]))
{
if($_POST["subject"]=='subject' ||$_POST["name"]=='name')
{
echo 'give your answer';
}
else if (!empty ( $_POST['subject']) && trim($_POST['subject'])!=='' &&
!empty ( $_POST['subject']) && trim($_POST['name'])!==''
&&
!empty ( $_POST['subject']) && trim($_POST['name'])!=='')
{
//echo 'hoy';
$s=$_POST['subject'];
$n=$_POST['name'];
$quiztype=$_POST['quiztype'];
$quiz_time=$_POST['quiz_time'];


//echo $s.$n;
//$quizz->add_discussion($s,mysql_real_escape_string($n),$iid);
$quiz_id=$quizz->add_quiz($s,mysqli_real_escape_string($conn,$n),$quiztype,$quiz_time);

//$quiz_id=$quizz->add_quiz($s,mysql_real_escape_string(htmlspecialchars($n)),$quiztype,$quiz_time);

$_SESSION['login'] = true;
$_SESSION['quiz_id']=$quiz_id;	
header("location:add_questiontype2.php?q=$quiz_id");

/*
mysql_query("INSERT INTO question(question_id,title,question_type_id,quizz_id) values ('','$q','1','$s')") or die(mysql_error());

$result = mysql_query("SELECT * FROM question WHERE quizz_id=$s order by question_id desc");
$count=mysql_num_rows($result);
if($count>0)
{
$user_data = mysql_fetch_array($result);
$question_id= $user_data['question_id'];
mysql_query("INSERT INTO question_values1(question_id,value,answer) values ('$question_id','$q','$a')") or die(mysql_error());
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
//mysql_query("INSERT INTO qset(qset_id,student_id,quizz_id,question_id) values ('','$s','$q','$value')") or die(mysql_error());
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



		  

	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Add quizz in a subject</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

		<select class="form-control" name="subject">
  <option name="subject" value="1">CSI 1: Computer Science</option>
  <option name="subject" value="2">Eng 1: Remedial Instruction in English Grammar</option>
  <option name="subject" value="3">Eng 2: Study and Thinking Skills</option>
  <option name="subject" value="4">Math 1: College Algebra</option>
  
    <option name="subject" value="5">PROF ED 2: Facilitating Learning</option>
  <option name="subject" value="6">STRAT 4: Principles of Teaching 1</option>
  <option name="subject" value="7">STRAT 5: Developmental Training 1</option>
  <option name="subject" value="8">ECON 1: Basic Economics Taxation, Agrarian Reform</option>
  
</select>
<br>
		
		 
		         <label for="inputPassword" class="sr-only">Summary</label>
				 <!--
        <input type="text" id="inputPassword" class="form-control" placeholder="Description of the Quizz" required name='name' value=''>
-->
  <textarea rows="10" id="inputPassword" class="form-control" placeholder="Description of the Quizz" required name='name' value=''></textarea><br>
					<select class="form-control" name="quiztype">
  <option name="subject" value="0">As exercise</option>
  <option name="subject" value="1">As quiz or exam</option>
</select>
<br>
<p>
			'As quiz or exam' -this means that this is considered as quiz or exams. This will hide scores and will accordingly show the students scores in due time.<br>
			'As exercise'- this means that this is in a form of an exercise. It will show scores and assessments.
			
          </p>
<br>

		         <label for="inputPassword" class="sr-only">Quiz time</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Quiz time" required name='quiz_time' value=''>

<br>
	

    
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
		        				<br>



		
      </form>




						<a class="btn btn-success" href="instructor_portal.php">
				Go back to home page!
				</a>
				<br>
					<br>





	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>