<?php
session_start();
ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$err_msg=' ';


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");




if(isset($_SESSION['student_id']) || isset($_SESSION['password']))
{
$student_id=$_SESSION['student_id'];
$password=$_SESSION['password'];
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

if(isset($_GET['addcom']))
{
if($_GET['addcom']=='1')
{
$_SESSION['student_id']=$student_id;
header("location:add_discussion_s.php");
}
}

if(isset($_GET['gotoquiz']))
{
if($_GET['gotoquiz']=='1')
{
$_SESSION['student_id']=$student_id;
header("location:quizpage.php?subject=1");
}
}



if(isset($_GET['subject']))
{
$subject=$_GET['subject'];
	
}


//for retest
if(isset($_GET['retest']))
{
$quiz_id=$_GET['retest'];
//reset scores and answers
$quizz->retest($student_id,$quiz_id);
//$quiz_id=$_POST["submit"];
$qf=$quizz->get_all_questions_quizz_array($student_id,$quiz_id);
$array_name=$qf;
$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$student_id;
$_SESSION['quiz_id']=$quiz_id;



//timer
$_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.
 
$result3 = mysql_query("SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysql_fetch_array($result3);
$quiz_time=$row["quiz_time"];
$_SESSION['quiz_time']=$quiz_time;
 
 
$_SESSION['expire'] = $_SESSION['start'] + ($quiz_time * 60);
header("location:index.php");
}








if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//echo hoy;
if(isset($_POST["submit"]))
{
if(!$quizz->check_student_exist($student_id))
{
$err_msg='Student id did not exists!';
}
else
{
$quiz_id=$_POST["submit"];
//echo $quiz_id;
$qf=$quizz->get_all_questions_quizz_array($student_id,$quiz_id);
$array_name=$qf;

$_SESSION['login'] = true;
$_SESSION['array_name']=$array_name;	
$_SESSION['student_id']=$student_id;
$_SESSION['quiz_id']=$quiz_id;

//timer
$_SESSION['start'] = time(); // Taking now logged in time.
 // Ending a session in 30 minutes from the starting time.
 
$result3 = mysql_query("SELECT * FROM quizz where quizz_id='$quiz_id'");
$row = mysql_fetch_array($result3);
$quiz_time=$row["quiz_time"];
$_SESSION['quiz_time']=$quiz_time;
 
 
$_SESSION['expire'] = $_SESSION['start'] + ($quiz_time * 60);
header("location:index.php");
}
}


else
$err_msg='This quiz is not yet applicable. Answer the other quiz first. Take quiz in ascending manner.';

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

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
             <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="login_quizz.php"><img src="logo1.png" style="width:90px;height:30px"></img></a>
			
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
echo 'Update profile picture';
echo '</a>';
}

       
?>
			
			
			
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="login_quizz.php">Student</a></li>
						                   <li class="">
                        <a class="page-scroll" href="#about">About the Subject</a>
                    </li>
			
				                   <li class="">
                        <a class="page-scroll" href="#lessons">Lessons and Discussions</a>
                    </li>
    
			
			
			                   <li class="">
                        <a class="page-scroll" href="#quiz">Exercise/Quiz/Exam</a>
                    </li>
    
	
			                   <li class="">
                        <a class="page-scroll" href="#othersubjects">Go to other subjects</a>
                    </li>
			
			
            <li class=""><a href="?q=logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	  
	  
	  
	  
	
	  
    </nav>

<br>

<!-- Subejct-->

  <section id="about" class="about-section">
    <div class="container">
	

    <div class="panel-group" id="accordion">
			  
		          <div class="panel panel-primary">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>PROF ED 2: Facilitating Learning</strong></a></h3>
			
            </div>
		            <div class="panel-body">
					
					
					         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">INSTRUCTOR</a>
          </strong>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
<div class="panel-body">
            In this subject you will be facilitated by <strong>Mr. Juanito Cristobal Jr.</strong> He will be glad to see you online. <br>
			<br>
			
			You are required to participate during the online community and to start you have to introduce yourself.
				<br>
				 <br>
			
<strong>
Your online educator and tutoring team</strong> <br>
On the whole duration of the subject you will be facilitated by <strong>Mr. Juanito Cristobal Jr.</strong> and you will be supported by <strong>Mr. Roldan Villaber and Mr. Rico langue.</strong>
 <br>
  <br>
<strong>
Assessment</strong> <br>
There will be series of quizzes and major exams to determine understanding with the subject. Your learning will come from participating in the subject activities, sharing your experiences, and participation during online discussions.



			
			
            </div>
				
                </div>
            </div>
        </div>
					
					
					
							         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTen">COURSE SYLLABUS</a>
          </strong>
            </div>
            <div id="collapseTen" class="panel-collapse collapse">
                <div class="panel-body">
				<p>
				COURSE CODE	: ED 3<br>
COURSE TITLE : Facilitating Learning<br>
NO.OF UNITS : Three (3)<br>
NO. OF HOURS : Fifty Four hours (54 hrs)<br>
				
				</p>
				
                </div>
            </div>
        </div>
        
					
					
					
         
		         <div class="panel panel-default">
				 
            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOneAR">COURSE DESCRIPTION</a>
          </strong>
            </div>
            <div id="collapseOneAR" class="panel-collapse collapse">
                <div class="panel-body">
				

      
					       
         <p>
		 The course is an introduction to psychological theories and principles as applied to the teaching and learning process. It focuses on individual capacities and motivations in the context of the Philippine educational system.
		 </p>
		
 
                </div>
            </div>
        </div>
		
		
		
		<div class="panel panel-default">
		

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">COURSE MODULES</a>
          </strong>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
				
<p>
		 <strong>
		Module 1: Introduction <br></strong>
		<br>
                1.1. Description of facilitating learning <br>
                1.2. Traditional and nontraditional facilitation of learning <br>
                1.3. Responsibilities of a facilitator of learning <br>
				<br>
          <strong>     
Module 2: Learning and diversity <br></strong>
<br>
                2.1. Learner diversity <br>
                                2.1.1. Race and ethnicity <br>
                                2.1.2. Culture <br>
                                2.1.3. Religion <br>
                                2.1.4. Socio economic status<br>
                                2.1.5. Gender<br>
                                2.1.6. Sexual orientation<br>
                                2.1.7. Language<br>
                                2.1.8. Abilities and Exceptionalities<br>
                                2.1.9. Resilience<br>
                2.2. Intelligence and learning style<br>
                                2.2.1. Theory of Multiple Intelligence by Howard Gardner<br>
                                2.2.2. Triarchic Theory of Intelligence by Robert Sternberg<br>
                                2.2.3. Learning and thinking styles<br>
                                2.2.4. Emotional Intelligence by Daniel Goleman<br>
                2.3. Learning and motivation<br>
                                2.3.1. Intrinsic and extrinsic motivation<br>
                                2.3.2. Attribution Theory<br>
                                2.3.3. Self-Efficacy theory<br>
                                2.3.4. Self-determination and Self-regulation Theories<br>
                                2.3.5. Choice Theory<br>
                                2.3.6. Hierarchy of Needs<br>
                                2.3.7. Goal Theory<br>
                2.4. Environmental Factors Affecting Motivation<br>
                                2.4.1. Social Environment<br>
                                2.4.2. Classroom Climate<br>
                                2.4.3. Physical Environment<br>
                                2.4.4. Direct and Indirect Assessment of Learning<br>
								<br>
<strong>
Module 3: Learning Theories<br></strong>
<br>
                3.1. Behaviorism<br>
                                3.1.1. Connectionism Theory by Edward L. Thorndike<br>
                                3.1.2. Classical Conditioning by Ivan Pavlov<br>
                                3.1.3. Original Behaviorism by John B. Watson (Overview)<br>
                                3.1.4. Practical Behaviorism by Edwin R. Guthrie (Overview)<br>
                                3.1.4. Physical Behaviorism by Clark Hull (Overview)<br>
                                3.1.5. Operant Conditioning by Bhurrus F. Skinner<br>
                3.2. Neo-Behaviorism<br>
                                3.2.1. Cognitive Behaviorism by Edward C. Tolman<br>
                                3.2.2. Social Learning Theory by Albert Bandurra<br>
                3.3. Cognitivism<br>
                                3.3.1. Gestalt Psychology by Max Wertheimer, Wolfgang Kohler, Kurt Kofka<br>
                                3.3.2. Information Processing Theory<br>
                                3.3.3. Meaningful Verbal Learning/Subsumption Theory by David Ausubel<br>
                                3.3.4. Conditions of Learning by Robert Gagné<br>
                                3.3.5. Constructivism<br>
                                                3.3.5.1. Constructivism by Jerome Bruner<br>
                                                3.3.5.2. Theory of Cognitive Development by Jean Piaget<br>
                                                3.3.5.3. Socio-cultural Theory by Lev Vygotsky<br>
                                                3.3.5.4. Knowledge Construction and Concept Learning<br>
                                3.3.6. Transfer of Learning<br>
                                3.3.7. Taxonomy of Objectives by Benjamin Bloom<br>
                                3.3.8. Problem Solving<br>
                                3.3.9. Creativity<br>
                                                3.3.9.1. Flow Theory of Creativity by Mihály Csíkszentmihályi (Overview)<br>
                                                3.3.9.2. Criteria of Creativity by Edward Paul Torrance<br>
                3.4. Other Learning Theories (optional)<br>
                                3.4.1. Theory of Andragogy by Malcolm Knowles<br>
                                3.4.2. Situated Learning Theory by Jean Lave<br>
								<br>
<strong>
Module 4: Learning and Development<br></strong>
<br>
                4.1. Psychosocial Theory of Intelligence by Erik Erikson<br>
                4.2. Psychoanalytic Theory by Sigmund Freud<br>
                4.3. Moral Development Theory by Lawrence Kohlberg<br>
                4.4. Bioecological Theory by Urie Bronfenbrenner<br>
				<br>
<strong>
Module 5: Fourteen Learner-Centered Psychological Principles<br>
</strong>
<br>
                5.1. Cognitive and metacognitive factors<br>
                5.2. Motivational and affective factors<br>
                5.3. Developmental and social factors<br>
                5.4. Individual differences factors<br>


		 </p>
			
			
			
			 </div>
				
     </div>
            </div>
		
		
		
				        <div class="panel panel-default">
		

            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">METHODOLOGIES:</a>
          </strong>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
				
<p>
		                1. Lecture Discussion<br>
                2. Cooperative Learning<br>
                3. Discovery Learning<br>
                4. Demonstration<br>
                5. Behavioral Analysis/Assessment<br>


		 </p>
                </div>
            </div>
        </div>
		
		

			        <div class="panel panel-default">
		
		            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">GRADING SYSTEM:</a>
          </strong>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
				
<p>
                1. Long Quiz/Short Quiz 				15 %<br>
                2. Recitation/Activities/Participation 			25%<br>
                3. Project  						10%<br>
                4. Assignment 					10%<br>
                5. Major Examinations 				40%<br>
                                                                                Total  		100%



		 </p>
                </div>
            </div>
			
			
			

	
        </div>
		
		

					        <div class="panel panel-default">
		
		            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">REFERENCES:</a>
          </strong>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="panel-body">
<p>
		              Academy of Orton-Gillingham Practitioners and Educators. (2011). Orton-Gillingham approach.[Retrieved: November 07, 2011].<br>
               Corpuz, B.B. &amp; Lucas, M.R.D. (2007). Facilitating learning: A metacognitive process. Cubao, Quezon City: Lorimar Publishing.
Dizon, P.B., Fulgencio, A.B., Gregorio, J.A., Obias, P.H.R., Vendivel, R.A., &amp; Gines, A.C. (2005).General   psychology: A textbook for college students. Mandaluyong City, Phil.: Omicron publishing.
<br>
               Junn, E.N. &amp; Broyatzis, C. edited (2004). Child growth and development, 13th ed. Connecticut: Dushkin/McGrawhill.<br>
                Kumar, M. (2004). Modern teaching of educational psychology. New Delhi, India: Anmol publishing Pvt. Ltd.<br>
                Pearson Education. (2010). Jerome Bruner and discovery learning. Pearson Prentice Hall. [Retrieved: November, 2011].<br>


		 </p>
                </div>
            </div>
			
			

	
       


		</div>


		 
		 
            </div>		  
	
	

		
		</div>
    </div>



	  		<a class="btn btn-default page-scroll" href="#about">Back to Top</a>
<br>
<br>
	  
	  

    </div><!-- /.container -->

	</section>

	
<!-- Discussions-->
<br>
  <section id="lessons" class="lessons">
    <div class="container">
	

    <div class="panel-group" id="accordion">
			  
		          <div class="panel panel-primary">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>Lessons and Discussions</strong></a></h3>
			
            </div>
		            <div class="panel-body">
					
					
					         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOneL">VIDEOS</a>
          </strong>
            </div>
            <div id="collapseOneL" class="panel-collapse collapse in ">
                <div class="panel-body">
<div class="panel-body">
             <div id="link"><a class="btn btn-success" href="#test_modal" data-toggle="modal">Introduction</a></div>
  
  		

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
<iframe class="embed-responsive-item" width="100%" height="300" src="//www.youtube.com/embed/Q-_m6rEj8Y4"?badge=0&amp;autoplay=1&amp;html5=1" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>

<br>
							
				(More videos will be posted soon.)<br>
			
			
            </div>
				
                </div>
            </div>
        </div>
					
					
					
							         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTenL">LATEST DISCUSSIONS</a>
          </strong>
            </div>
            <div id="collapseTenL" class="panel-collapse collapse">
                <div class="panel-body">

					
								<a class="btn btn-success" href="?addcom=1"><strong>Forums and Add comments</strong></a><br>
			<br>
				(More discussions will be posted soon.)<br>				

			

		
			
					</div>
			
	
			
				
                </div>
            </div>

		
		
	
					
					
					        <div class="panel panel-default">
		
		            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSixL">DOWNLOAD MATERIALS</a>
          </strong>
            </div>
            <div id="collapseSixL" class="panel-collapse collapse">
                <div class="panel-body">
<p>
<a href="download.php">Click here to download materials! <br>Module 1_Introduction_Facilitating Learning.docx</a>

		 </p>
                </div>
            </div>
			
			

	
       


		</div>



		 
		 
            </div>		  
	
	

		
		</div>
    </div>



	  		<a class="btn btn-default page-scroll" href="#about">Back to Top</a>
<br>
<br>
	  
	  

    </div><!-- /.container -->

	</section>
	
	

<!-- Quizzes-->
<br>
  <section id="quiz" class="quiz">
    <div class="container">
	

    <div class="panel-group" id="accordion">
			  
		          <div class="panel panel-primary">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>Exercises, Quizzes, and Exams</strong></a></h3>
			
            </div>
		            <div class="panel-body">
					
					
					         <div class="panel panel-default">

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOneQ">Module 1</a>
          </strong>
            </div>
            <div id="collapseOneQ" class="panel-collapse collapse in">
                <div class="panel-body">
		<p class="lead">Your progress to Module1</p>
		<div class="progress progress-striped">
    <div class="progress-bar progress-bar-warning" style="width:<?php
$width=$quizz->progresbar_byquiz($student_id);echo $width."%".";";?>">
        <span class="sr-only">10% Complete</span>
    </div>
</div>	
<?php
$width=$quizz->progresbar_byquiz($student_id);
echo "<p class='lead'>";
echo "$width";
echo "%";

echo " completed.";
echo "</p>";
?>	
	<hr>
	
			<a class="btn btn-success" href="?gotoquiz=1"><strong>Go to Quiz/Exercise/Exam</strong></a><br>
	



				
				
           
            </div>
			</div>
        </div>
					
					
					

		 
            </div>		  
	
	

		
		</div>
    </div>
		  		<a class="btn btn-default page-scroll" href="#about">Back to Top</a>
<br>
<br>

</section>




	
	
	
<!--go to other subjects-->
  <section id="othersubjects" class="othersubjects">
       

	   
	       <div class="container">
	   
    <div class="panel-group" id="accordion">
	
			  
		          <div class="panel panel-primary">
				              <div class="panel-heading">
						
              <h3 class="panel-title"><a href="#"><strong>Go to other Subjects</strong></a></h3>
			
            </div>
		            <div class="panel-body">
         
		        
		
        <div class="panel panel-default">
            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoD">STRAT 4: Principles of Teaching 1</a>
          </strong>
            </div>
            <div id="collapseTwoD" class="panel-collapse collapse">
                <div class="panel-body">
				
				         <p>
		 Course information is not yet ready.
		 </p>
		
           
                </div>
            </div>
        </div>
        <div class="panel panel-default">
		

            <div class="panel-heading">
             <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThreeD">STRAT 5: Developmental Training 1</a>
          </strong>
            </div>
            <div id="collapseThreeD" class="panel-collapse collapse">
                <div class="panel-body">
				
								         <p>
		 Course information is not yet ready.
		 </p>
				
        
                </div>
            </div>
        </div>
		        <div class="panel panel-default">
		

            <div class="panel-heading">
                 <strong>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourD">ECON 1: Basic Economics Taxation, Agrarian Reform</a>
          </strong>
            </div>
            <div id="collapseFourD" class="panel-collapse collapse">
                <div class="panel-body">
				
								         <p>
		 Course information is not yet ready.
		 </p>
				
        
                </div>
            </div>
        </div>
		


		 
		 
            </div>		  
	
	
	</div>
		
		</div>
						  		<a class="btn btn-default page-scroll" href="#about">Back to Top</a>
						<br>
<br>
    </div>
	

	  
		</section>   
		



    </div><!-- /.container -->

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script> 
	<script>
	
    $('#link').click(function () {
    //    var src = src='//www.youtube.com/embed/Q-_m6rEj8Y4"?badge=0&amp;autoplay=1&amp;html5=1';
        $('#myModal').modal('show');
      //  $('#myModal iframe').attr('src', src);
    });
/*
$('#myModal').on('hidden.bs.modal', function () {
    $('#myModal iframe').removeAttr('src');
})*/
</script>
	

	
	
    <!-- jQuery 
    <script src="dist/js/jquery.js"></script>
	-->

    <!-- Bootstrap Core JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="dist/js/jquery.easing.min.js"></script>
    <script src="dist/js/scrolling-nav.js"></script>

  </body>
</html>

