<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$msg='';
$answers_id='';

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
session_destroy();
header("location:login_instructor.php");
}
}

if(isset($_GET['answers_id']))
{
$answers_id=$_GET['answers_id'];
//echo $toshow.$toshowid;
//$quizz->update_quiz($toshow,$toshowid);
//$msg='Scores for Quiz '.$toshowid.' is now visible in the student page after taking the exam.';
}



if(isset($_GET['showanswers']))
{
$quiz_id=$_GET['showanswers'];
//echo $toshow.$toshowid;
//$quizz->update_quiz($toshow,$toshowid);
//$msg='Scores for Quiz '.$toshowid.' is now visible in the student page after taking the exam.';
}

if(isset($_GET['student']))
{

$student_id=$_GET['student'];
//$quizz->update_quiz($toshow,$toshowid);
//$msg='Scores for Quiz '.$toshowid.' is now not visible in the student page after taking the exam.';
}


if(isset($_GET['updateanswer']) && isset($_GET['answerid']))
{

$updateans_id=$_GET['updateanswer'];
$answerid=$_GET['answerid'];

if($updateans_id=='1')
{
//echo $updateans_id.$answerid;
$quizz->update_answer($updateans_id,$answerid,$student_id,$quiz_id);
//$_SESSION['quiz_id']=$quiz_id;
//$_SESSION['student_id']=$student_id;
}
else
{
$quizz->update_answer('0',$answerid,$student_id,$quiz_id);
$_SESSION['quiz_id']=$quiz_id;
$_SESSION['student_id']=$student_id;
}

//$quizz->update_quiz($toshow,$toshowid);
//$msg='Scores for Quiz '.$toshowid.' is now not visible in the student page after taking the exam.';
}




if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["feedback"]))
{
//echo 'hoy';
//$s=$_POST['subject'];
$c=$_POST['feedback'];
//echo $c.$quiz_id;
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$quizz->add_feedback(mysqli_real_escape_string($conn,$c),$quiz_id,$student_id);

//echo $s.$n;
//$quizz->add_discussion($s,$n,$iid);
//$result3 = mysqli_query("SELECT * FROM discussion order by id desc");
//$row = mysqli_fetch_array($result3);
//$subject=$row["subject"];

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

	<script language="JavaScript" type="text/javascript" src="wysiwyg_beta/wysiwyg.js">

</script>
  
  </head>

  <body>




    <div class="container">
	
	    <p><a href="instructor_portal.php" class="btn btn-primary btn-block" role="button">Back to home page</a></p>

		 
<br>
	<?php
echo $msg;
?>


			
			<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Edit Answers</div>

  <!-- Table -->
  <div class="table-responsive">
              <table class="table" style="width:auto">
        <thead>
            <tr>
                <th>Answer ID</th>
				                <th>Question</th>
								 <th>Result</th>
								               <th>Correct answer</th>
											   								               <th>Your answer</th>
 

				
            </tr>
        </thead>
        <tbody>
		<?php
$quizz->show_answer($student_id,$quiz_id)
		?>
		

  
	 </tbody>
    </table>
	


</div>
</div>

	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Add feedback to student on this quiz</h2>
<br>
	
			   <div class="table-responsive">
<textarea rows="10" id="textarea1" name="feedback" placeholder="feedback" ></textarea>
<script language="JavaScript">
  generate_wysiwyg('textarea1');
</script>
</div>
	<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
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