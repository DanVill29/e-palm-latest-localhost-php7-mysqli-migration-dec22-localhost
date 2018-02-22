<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$subject=1;
$iid=0;
$editdisc=0;
//echo $subject;


if(isset($_SESSION['instructor_id']) && isset($_SESSION['password']))
{
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];	
}




if(isset($_GET['iid']))
{
$iid=$_GET['iid'];
//echo $iid;
}


if(isset($_GET['editdisc']))
{
$editdisc=$_GET['editdisc'];
//echo $editdisc;

$_SESSION['editdisc']=$editdisc;
$_SESSION['instructor_id']=$instructor_id;
header("location:add_comment.php");
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
if(isset($_POST["discussion"]) && isset($_POST["subject"]))
{
if($_POST["discussion"]<>"")
{
//echo 'hoy';
$s=$_POST['subject'];
$n=$_POST['discussion'];


//echo $s;
 		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$quizz->add_discussion($s,mysqli_real_escape_string($conn,$n),$iid);
/*
$result3 = mysqli_query("SELECT * FROM discussion order by id desc");
$row = mysqli_fetch_array($result3);
*/
$subject=$s;
echo $subject;

//$quiz_id=$quizz->add_quiz($s,$n,$quiztype);
//$_SESSION['login'] = true;
//$_SESSION['quiz_id']=$quiz_id;	
header("location:add_discussion.php");

}

//no answer


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
	 	 <!--   <link href="wysiwyg_beta/styles/styles.css" rel="stylesheet">
		 -->

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
	
			    <script src="dist/js/bootstrap.min.js"></script>
	


<script language="JavaScript" type="text/javascript" src="wysiwyg_beta/wysiwyg.js">

</script>
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

    <p><a href="instructor_portal.php" class="btn btn-primary btn-block" role="button">Back to home page</a></p>


		  

	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Add Discussions</h2>
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
		
		 
		         <label for="inputPassword" class="sr-only">Discussion</label>

			   <div class="table-responsive">
<textarea rows="10" id="textarea1" name="discussion" placeholder="Discussion" ></textarea>
<script language="JavaScript">
  generate_wysiwyg('textarea1');
</script>



</div>
    <br>
	
	

        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
		        				<br>

		

		
      </form>
<div class="well well-large">
   	  		<?php
$quizz->show_alldiscussion_inasubject("",$iid);
		?>
</div>








	
	  <br>



						<a href="instructor_portal.php">
				Go back to home page!
				</a>
				<br>
					<br>





	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript

    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


  


  </body>
</html>