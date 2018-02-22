<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();
$msg='';
$editquiz='';
$qtype='';
$qtitle='';
$answer='';
$qtypef1='';
$qtypef2='';
$qtypef3='';
$quiz_id='';
$mchoice='';
$mchoiceid='';
$instructor_id=$_SESSION['instructor_id'];
$password=$_SESSION['password'];


$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




if(isset($_SESSION['student_id']))
{
$student_id=$_SESSION['student_id'];
}

if(isset($_SESSION['quiz_id']))
{
$quiz_id=$_SESSION['quiz_id'];
//echo $quiz_id;
}




if(isset($_GET['q']))
{
if($_GET['q']=='logout')
{
$quizz->user_logout();
header("location:login_instructor.php");
}
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



if(isset($_GET['deleteq']))
{
$qidtodelete=$_GET['deleteq'];
//echo $qidtodelete;
$quizz->delete_question($qidtodelete);
header("location:edit_quiz2.php");

}


//deletenumid name
if(isset($_GET['deletenumid']))
{
$deletenumid=$_GET['deletenumid'];
//echo $qidtodelete;
$quizz->delete_multiplechoice($deletenumid);
//mysqli_query("DELETE FROM question_enum_values WHERE enum_value_id='$deletenumid'");
//header("location:edit_quiz2.php");

}
//editnumid

if(isset($_GET['editnumid']) && isset($_GET['name']))
{
$editnumid=$_GET['editnumid'];
$name=$_GET['name'];
//echo $qidtodelete;

//mysqli_query("DELETE FROM question_enum_values WHERE enum_value_id='$deletenumid'");
$_SESSION['editnumid']=$editnumid;
$_SESSION['name']=$name;
header("location:edit_choice.php");

}




if(isset($_GET['editquiz']) && isset($_GET['qtype']) && isset($_GET['qtitle']) && isset($_GET['answer']))
{
$editquiz=$_GET['editquiz'];
//echo $editquiz;
$qtype=$_GET['qtype'];
//echo $qtype;
$qtitle=$_GET['qtitle'];
//echo urldecode($qtitle);
$answer=$_GET['answer'];



if($qtype=='1')
{
$qtypef1='open-end';
$qtypef2='multiple-choice';
$qtypef3="<option name='qtype' value='$qtype'>".$qtypef1.'</option>'.'<option name="qtype" value="2">'.$qtypef2.'</option>';

}
else if($qtype=='2')
{
//echo $qtype;
$qtypef1='multiple-choice';
$qtypef2='open-end';
$qtypef3="<option name='qtype' value='$qtype'>".$qtypef1.'</option>'.'<option name="qtype" value="1">'.$qtypef2.'</option>';


//get the options and display
$result2 = mysqli_query($conn,"SELECT * FROM question_enum_values WHERE question_id='$editquiz' order by enum_value_id asc");
$user_data2 = mysqli_fetch_array($result2);
$question_id2= $user_data2['enum_value_id'];
//echo $question_id2;
$result = mysqli_query($conn,"SELECT * FROM question_enum_values WHERE question_id='$editquiz' and enum_value_id <> '$question_id2' order by enum_value_id asc");
$count=mysqli_num_rows($result);
if($count>0)
{

while($user_data = mysqli_fetch_array($result))
{
//$question_id= $user_data['question_id'];
//echo $user_data['name'];
//echo '<br>';
//$mchoice2=$user_data['name'];

//$mchoice="<input type='text' id='inputPassword' class='form-control' placeholder='question title' required name='mchoice' value='$mchoice2'>";
//echo $mchoice;'

//echo $user_data['name'];
//echo '<br>';

//$mchoice[]=$user_data['name'];
$mchoiceid[]=$user_data['enum_value_id'];
        
}
}



}


}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//open end
if(isset($_POST["question_id"]) && isset($_POST["qtype"]) && isset($_POST["title"]) && isset($_POST["answer"]))
{
$s=$_POST['question_id'];
$q=$_POST['title'];
$a=$_POST['answer'];
$b=$_POST['qtype'];
//echo $s;
//echo $q;
//echo $a;
//echo $b;
//$quizz->add_question('1',$s,$q,$a);

mysqli_query("UPDATE question SET question_type_id='$b',title='$q' WHERE question_id='$s'");
mysqli_query("UPDATE question_values1 SET value='$q',answer='$a' WHERE question_id='$s'");
mysqli_query("UPDATE question_enum_values SET name='$a' WHERE enum_value_id='$question_id2'");
header("location:edit_quiz2.php");

//if change to question type open-end, will delete multiple choice in values1 table
if($b <> $qtype)
{
if($b=='1')
{
mysqli_query($conn,"DELETE FROM question_enum_values WHERE question_id='$s'");
header("location:edit_quiz2.php");
}
else if($b=='2')
{
mysqli_query($conn,"INSERT INTO question_enum_values(question_id,enum_value_id,name) values('$s','','$a')") or die(mysqli_error());
$_SESSION['question_id']=$s;
header("location:add_questiontype2_addmore.php");
}
}








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


    <!-- Custom styles for this template -->
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
                <th>Question ID</th>
                <th>Title</th>
                <th>Question ID</th>
				
            </tr>
        </thead>
        <tbody>
		<?php
$quizz->show_allquestion_inaquiz($quiz_id)
		?>
		

  
	 </tbody>
    </table>
	</div>
	</div>
	

     </div>
	 




	   <form class="form-signin" role="form" method='post' action=''>
        <h2 class="form-signin-heading">Update question</h2>
		<p>(Click Edit Question menu in a question ID)</p>
		<br>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

		
        <label for="inputPassword" class="sr-only">Quiz number</label>
						  <p>Question ID: 
				  </p>
				  
        <input readonly="readonly" type="text" id="inputPassword" class="form-control" placeholder="Question ID" required name='question_id' value='<?php 
		echo $editquiz;
		
		?>'>
		
		<br>
		<!--
		        <input type="text" id="inputPassword" class="form-control" placeholder="Question Type" required name='qtype' value='<?php 
		echo $qtype;
		
		?>'>
		-->
		
					  <p>Question Type: 
				  </p>
		
		<select class="form-control" name="qtype">

<?php echo $qtypef3;?>
</select>
		
		
		<br>
		
					  <p>Question Title: 
				  </p>
		 
		         <label for="inputPassword" class="sr-only">Question</label>

        <input type="text" id="inputPassword" class="form-control" placeholder="question title" required name='title' value="<?php 
		echo htmlspecialchars($qtitle);
		
		?>">
		 <br>
		 		  <p>Question Answer: 
				  </p>
		 
		 		         <label for="inputPassword" class="sr-only">Answer</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="answer" required name='answer' value="<?php 
		echo urldecode($answer);
		
		?>">
		 <br>
			
			<!--
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
		-->
		
<?php

//$mchoice="<input type='text' id='inputPassword' class='form-control' placeholder='question title' required name='mchoice' value='$mchoice2'>";
//echo $mchoice;

if($qtype=='2' and $mchoiceid <> "")
{
echo 'Other Multiple choices';


foreach($mchoiceid as $value)
{
//get the options and display
$result2 = mysqli_query($conn,"SELECT * FROM question_enum_values WHERE enum_value_id='$value' order by enum_value_id asc");
$user_data2 = mysqli_fetch_array($result2);
$enum_value_id= $user_data2['enum_value_id'];
$name= $user_data2['name'];
$name2= 'mchoiceenumvalueid'.$user_data2['enum_value_id'];





$mchoice='<input type="text" id="inputPassword" class="form-control" placeholder="question title" required name="name2" value='.$name.'>';
echo $mchoice;

echo '<a href="?deletenumid='.$enum_value_id.'">'.'Delete'.'</a>';
echo ' | ';
echo '<a href="?editnumid='.$enum_value_id.'&&name='.$name.'">'.'Edit'.'</a>';
echo '<br>';
echo '<br>';

}

}


?>
		
		
		
		
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>


	<br>
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