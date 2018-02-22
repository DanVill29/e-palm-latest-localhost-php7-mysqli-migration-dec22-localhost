<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg='';


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");



if(isset($_SESSION['student_id']) && isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
//echo $student_id;
$password=$_SESSION['password'];
}

if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
}


if(!$quizz->check_student_exist($student_id))
{
$_SESSION['login'] = FALSE;
$err_msg='Login id did not exists!';
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



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["student_id"]) && isset($_POST["quizz_id"]))
{

if (!empty ( $_POST['student_id']) && trim($_POST['student_id'])!=='' &&
!empty ( $_POST['quizz_id']) && trim($_POST['quizz_id'])!=='')
{
$s=$_POST['student_id'];
$q=$_POST['quizz_id'];
echo $q.$s;

if(!$quizz->check_student_exist($s))
{
$err_msg='Student id did not exists!';
}
else
{
//echo 'wah!';
$qf=$quizz->get_all_questions_quizz_array($student_id,$q);
$array_name=$qf;


/*
*/
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$s;
$_SESSION['quiz_id']=$q;
header("location:index.php");


}

}


else
echo 'give your answer';
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
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="logo1.png" style="width:40px;height:30px"></img></a>
		  
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
echo '<small>';
				  echo 'Update profile picture';
				  echo '</small>';
echo '</a>';
}

       
?>

	   </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="login_quizz2.php">Student</a></li>
			<li ><a href="enrollsubjects.php">Enroll subjects</a></li>
			<li ><a href="grades.php">Grades</a></li>
            <li><a href="?q=logout">Logout</a></li>
		
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>



    <div class="container">

		<br>
	<br>

    <div class="panel-group" id="accordion">
			  
		          <div class="panel panel-default">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="subject1.php?subject=1"><strong>Grades</strong></a></h3>
			
            </div>
		            <div class="panel-body">
         
		         <div class="panel panel-default">
				 
            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">CSI 1: Computer Science</a>
          </strong>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
  <div class="table-responsive">
              <table class="table" style="width:auto">
        <thead>
            <tr>
                <th>Prelim</th>
				                <th>Midterm</th>
								 <th>Pre-Final</th>
								               <th>Final</th>
											   								       
 

				
            </tr>
        </thead>
        <tbody>
<?php
		$quizz->show_grades($student_id,"1");

  ?>
	 </tbody>
    </table>
	


</div>
                </div>
            </div>
        </div>
        
 
		        <div class="panel panel-default">
		

            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">PROF ED 2: Facilitating Learning</a>
          </strong>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
				<div class="table-responsive">
              <table class="table" style="width:auto">
        <thead>
            <tr>
                <th>Prelim</th>
				                <th>Midterm</th>
								 <th>Pre-Final</th>
								               <th>Final</th>
											   								       
 

				
            </tr>
        </thead>
        <tbody>
<?php
		$quizz->show_grades($student_id,"5");

  ?>
	 </tbody>
    </table>
	


</div>
        
                </div>
            </div>
        </div>
		


		 
		 
            </div>		  
	
	

		
		</div>
    </div>



<!--
        <div class="panel panel-primary">
            <div class="panel-heading">
						
              <h3 class="panel-title"><a href="subject1.php?subject=1"><strong>PROF ED 2: Facilitating Learning</strong></a></h3>
			
            </div>
            <div class="panel-body">
               <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		  
		  
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=2"><strong>STRAT 4: Principles of Teaching 1</strong></a></h3>
            </div>
            <div class="panel-body">
                     <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=3"><strong>STRAT 5: Developmental Training 1</strong></a></h3>
            </div>
            <div class="panel-body">
                       <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  
		          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><a href="subject1.php?subject=4"><strong>ECON 1: Basic Economics Taxation, Agrarian Reform</strong></a></h3>
            </div>
            <div class="panel-body">
                         <a href="subject1.php?subject=1"><strong>Start here</strong></a>
            </div>
          </div>
		  

-->





	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>