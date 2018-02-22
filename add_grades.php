<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$prelim="";
$midterm="";
$pre_final="";
$final="";


if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}



if(isset($_SESSION['instructor_id']) && isset($_SESSION['password']))
{
$instructor_id=$_SESSION['instructor_id'];
//echo $instructor_id;
$password=$_SESSION['password'];	


//
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result3 = mysqli_query($conn,"SELECT * FROM instructor where id='$instructor_id'");
$row = mysqli_fetch_array($result3);
$fullname=$row["name"];
}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["subject"]) && isset($_POST["grade"]) && isset($_POST["period"]) && isset($_POST["student"]))
{
//echo 'hoy';
$s=$_POST['subject'];


$n=$_POST['grade'];
if($n>3.0)
{
//echo 'hagbong!';
$cleared=0;
}
else
{
//echo 'pasar ka!';
$cleared=1;
}

$p=$_POST['period'];
$l=$_POST['student'];
//$quiztype=$_POST['quiztype'];
if($p=="Prelim")
{
$prelim=$n;
}
else if($p=="Midterm")
{
$midterm=$n;
}
else if($p=="Pre-Final")
{
$pre_final=$n;
}
else if($p=="Final")
{
$final=$n;
}
else{
$prelim="";
$midterm="";
$pre_final="";
$final="";
}
//echo $s.$n.$p.$l;
$quiz_id=$quizz->add_grades($l,$prelim,$midterm,$pre_final,$final,$s,$p,$cleared);
//$_SESSION['login'] = true;
//$_SESSION['quiz_id']=$quiz_id;	
//header("location:add_questiontype2.php?q=$quiz_id");

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



		  

	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Add grades in a subject</h2>
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

		<select class="form-control" name="period">
  <option name="period" value="Prelim">Prelim</option>
  <option name="period" value="Midterm">Midterm</option>
  <option name="period" value="Pre-Final">Pre-Final</option>
  <option name="period" value="Final">Final</option>
</select>
<br>
<!--
		         <label for="inputPassword" class="sr-only">Summary</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="student id" required name='student' value=''>
		-->
				<select class="form-control" name="student">
		<?php
		$quizz->show_allstudentinasubject_indropdwon();
		?>
		</select>
		
		<br>
		 
		         <label for="inputPassword" class="sr-only">Summary</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Add grades here!" required name='grade' value=''>


<br>

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