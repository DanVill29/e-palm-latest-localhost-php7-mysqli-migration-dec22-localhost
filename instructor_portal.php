<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg='';
$quiz_id="";
$quiz_id1="";
$quiz_id2="";
$quiz_id3="";
$quiz_id4="";
//echo $quiz_id;





//timer
$now = time(); // Checking the time now when home page starts.
if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:login_instructor.php");
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



if(!$quizz->check_instructor_exist($instructor_id,$password))
{
$quizz->user_logout();
header("location:login_instructor.php");
}


if (!$quizz->get_session())
{
header("location:login_instructor.php");
}

if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
session_destroy();
header("location:login_instructor.php");
}
}

if(isset($_GET['clearance']) && isset($_GET['subject']) && isset($_GET['student_id']))
{
if($_GET['clearance']=='1')
{
$subject=$_GET['subject'];
$student_id=$_GET['student_id'];
//echo $subject;
$student_id=$_GET['student_id'];
mysql_query("UPDATE grades SET cleared='1' WHERE subject='$subject' and student_id='$student_id'");
header("location:instructor_portal.php");
}
}


//send email
//$password='epalm';
//$email='jauisland@gmail';
//$firstname="student";


if(isset($_GET['activate']) && isset($_GET['student_id']))
{
if($_GET['activate']=='1')
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo $subject;
$student_id=$_GET['student_id'];
mysqli_query($conn,"UPDATE student SET activate='1' WHERE student_id='$student_id'");
$row = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM student where student_id='$student_id'"));
$email=$row["email"];
$password=$row['password'];
$firstname=$row['firstname'];



//send email notification to students
$subject ='e-Palm Online Notification: You are now officially enrolled to e-Palm Online!';
//$subject ='e-Palm Online Notification';

//$to = 'Roldan.Villaber@SurveySampling.com';

//$recipients = array("jauisland@gmail.com","roldan.villaber@surveysampling.com");
//$to = implode(',', $recipients); ;


//$to = $email;
/**/
$body = 'Dear '.$firstname.','.'<br>'.
'<br>'.
'We would like to inform you that you are now enrolled.'.
'<br>'.
'Your login details below:'.
'<br>'.'Student ID:'.$student_id.
'<br>'.'Password: '.$password.

'<br>'.
'<br>'.
'http://www.e-palm.net/login_student.php'.


'<br>'.
'<br>'.
'Kind regards, '.
'<br>'.
'e-Palm Online Team';


$quizz->send_email($subject,$email,$body);



}
}





if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["quizz_id1"]))
{
//echo $_POST["quizz_id1"];
$quiz_id1=$_POST["quizz_id1"];
}
else if(isset($_POST["quizz_id2"]))
{
//echo $_POST["quizz_id1"];
$quizz_id2=$_POST["quizz_id2"];
}
else if(isset($_POST["quizz_id3"]))
{
//echo $_POST["quizz_id1"];
$quizz_id3=$_POST["quizz_id3"];
}
else if(isset($_POST["quizz_id4"]))
{
//echo $_POST["quizz_id1"];
$quizz_id4=$_POST["quizz_id4"];
}


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
        <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />

    <title>e-Palm</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	
    <!--
    <link href="starter-template.css" rel="stylesheet">
	-->

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
				Add quiz
				</a></li>
                  <li>		<a href="add_questiontype2.php">
				Add new multiple choice question
				</a></li>
								</a></li>
                       <li>		<a href="add_questiontype1.php">
				Add open-end question
				</a></li>
				 <li>				<a href="edit_quiz.php">
				Edit quiz and scores
				</a></li>
								 <li>				<a href='add_discussion.php?iid=<?php echo $instructor_id; ?>'>
				Add discussion
				</a></li>
				
				              <li>				<a href="add_grades.php">
				Add grades
				</a></li>
				
				
								</a></li>
                  <li>				<a href="student_enroll2.php">
				Enroll a student
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
	    <div class="panel panel-default">
            <div class="panel-heading">
              <h7 class="page-title"><?php echo "Welcome, ".$fullname."!"; ?></h7>
            </div>

          </div>


		  

		
        <div class="panel panel-primary">
            <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>Manage Enrollment</strong></a></h3>
			
            </div>
            <div class="panel-body">
             <div class="bs-example">
			   <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
              <th>Student ID</th>
                <th>Full Name</th>
				     <th>Email</th>
					  <th>Contact Number</th>


			   
            </tr>
        </thead>
        <tbody>
		  		<?php
$quizz->manage_enrollment();	
		?>
		

  
	 </tbody>
    </table>
	
		<br>
		


		
</div>
</div>
            </div>
          </div>
		  
		  
        <div class="panel panel-primary">
            <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>CSI 1: Computer Science</strong></a></h3>
			
            </div>
            <div class="panel-body">
             <div class="bs-example">
			   <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
              <th>Student ID</th>
                <th>Full Name</th>
               <th>Latest Quiz Score</th>
			   <th>Contact Details</th>

			   
			   

			   
            </tr>
        </thead>
        <tbody>
		<?php
$quizz->show_studentperformance_subject('1',$quiz_id1);	
		?>
		

  
	 </tbody>
    </table>
	
		<br>
		
			   <form class="form-signin" role="form" method='post' action=''>
			   
			   			   				<select class="form-control" name="quizz_id1">
		<?php
$quizz->showquizzes_persubject('1');
		?>
		
</select>

<br>

        <button class="btn btn-sm btn-primary btn-block" type="submit">Search by Quiz</button>
		        				<br>



		
      </form>

		
</div>
</div>
            </div>
          </div>
		  




        <div class="panel panel-primary">
            <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>PROF ED 2: Facilitating Learning</strong></a></h3>
			
            </div>
            <div class="panel-body">
             <div class="bs-example">
			   <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
              <th>Student ID</th>
                <th>Full Name</th>
               <th>Latest Quiz Score</th>
			   <th>Contact Details</th>

			   
			   

			   
            </tr>
        </thead>
        <tbody>
		<?php
$quizz->show_studentperformance_subject('5',$quiz_id1);	
		?>
		

  
	 </tbody>
    </table>
	
		<br>
		
			   <form class="form-signin" role="form" method='post' action=''>
			   
			   			   				<select class="form-control" name="quizz_id1">
		<?php
$quizz->showquizzes_persubject('5');
		?>
		
</select>

<br>

        <button class="btn btn-sm btn-primary btn-block" type="submit">Search by Quiz</button>
		        				<br>



		
      </form>

		
</div>
</div>
            </div>
          </div>
		  




	  
	  
	  

    </div><!-- /.container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
   
  </body>
</html>