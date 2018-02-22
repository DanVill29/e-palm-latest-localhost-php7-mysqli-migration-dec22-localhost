<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$msg='';
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];

if(isset($_SESSION['student_id']))
{
$student_id=$_SESSION['student_id'];
}

if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
}




if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
}



if(isset($_GET['editquiz']))
{
$quiz_id=$_GET['editquiz'];
//echo $quiz_id;

$_SESSION['quiz_id']=$quiz_id;
header("location:edit_quiz2.php");
}




if(isset($_GET['showscoreid']))
{
$toshow="1";
$toshowid=$_GET['showscoreid'];
//echo $toshow.$toshowid;
$quizz->update_quiz($toshow,$toshowid);
$msg='Scores for Quiz '.$toshowid.' is now visible in the student page after taking the exam.';
}

if(isset($_GET['hidescoreid']))
{
$toshow="0";
$toshowid=$_GET['hidescoreid'];
$quizz->update_quiz($toshow,$toshowid);
$msg='Scores for Quiz '.$toshowid.' is now not visible in the student page after taking the exam.';
}

if(isset($_GET['deleteq']) && isset($_GET['showscoreid']))
{
$qidtodelete=$_GET['deleteq'];
$showscoreid=$_GET['showscoreid'];
if($qidtodelete=='1')
{
$quizz->delete_quiz($showscoreid);
//$msg='Quiz '.$showscoreid.' has been deleted.';
header("location:edit_quiz.php");
//$msg='Quiz '.$showscoreid.' has been deleted.';

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
	<?php
echo $msg;
?>

   <div class="panel panel-primary">
   
     <div class="panel-heading">
						
  
            </div>
			
						   <div class="table-responsive">
			
			     <div class="panel-body">

    <table class="table">
        <thead>
            <tr>
                <th>Quiz ID</th>
                <th>Subject</th>
                <th>Name</th>
				
            </tr>
        </thead>
        <tbody>
		<?php
$quizz->show_allquizzid();
		?>
		

  
	 </tbody>
    </table>
	</div>
	</div>
	

     </div>


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