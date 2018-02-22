<?php
session_start();
//$_SESSION['array_name']=$array_name;

ob_start();
include_once 'quizz_engine.php';
include_once 'db_connect.php';
$quizz = new quizz_engine();

$err_msg="";



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
/*
echo $_POST["gender"];
echo '<br>';
echo $_POST["fname"];
echo '<br>';
echo $_POST["lname"];
echo '<br>';
echo $_POST["age"];
echo '<br>';
echo $_POST["address"];
echo '<br>';
echo $_POST["cellnumber"];
echo '<br>';
echo $_POST["course"];
echo '<br>';
echo $_POST["confirm_password"];
echo '<br>';
echo $_POST["password"];
echo '<br>';
echo $_POST["subject1"];
echo '<br>';

echo $_POST["subject2"];
echo '<br>';
echo $_POST["subject3"];
echo '<br>';
echo $_POST["subject4"];
echo '<br>';

*/


//open end
if(isset($_POST["gender"]) 
&& isset($_POST["fname"]) && isset($_POST["lname"])
&& isset($_POST["age"]) && isset($_POST["address"])
&& isset($_POST["cellnumber"]) 
&& isset($_POST["email"]) 
&& isset($_POST["password"]) && isset($_POST["confirm_password"])
)
{
if($_POST["fname"]=='first name' ||$_POST["lname"]=='last name'
||$_POST["age"]=='age' ||$_POST["address"]=='address'
||$_POST["cellnumber"]=='cellnumber'|| $_POST["password"]=='password' ||$_POST["confirm_password"]=='confirm_password'
)
{
$err_msg="Check the fields!";
}

//
else if($_POST["password"] <> $_POST["confirm_password"])
{
$err_msg='Mismatch password and confirm_password';
}

else if(!isset($_POST["gender"]))
{
$err_msg="Check the fields!";
}

else if(!isset($_POST["subject1"]) && !isset($_POST["subject2"])
&& !isset($_POST["subject3"]) && !isset($_POST["subject4"])
)
{
$err_msg="Select at least one subject!";
}

else if(!is_numeric($_POST["age"]))
{
$err_msg="Age should be integer. Must be 16 years old and above.";
}

else if(!is_numeric($_POST["cellnumber"]))
{
$err_msg="Cellnumber should be integer.";
}


//OK--
else if (!empty ( $_POST['gender']) && trim($_POST['gender'])!=='' &&
!empty ( $_POST['fname']) && trim($_POST['fname'])!==''
&& !empty ( $_POST['lname']) && trim($_POST['lname'])!==''
&& !empty ( $_POST['age']) && trim($_POST['age'])!==''
&& !empty ( $_POST['address']) && trim($_POST['address'])!==''
&& !empty ( $_POST['cellnumber']) && trim($_POST['cellnumber'])!==''
//&& !empty ( $_POST['course']) && trim($_POST['course'])!==''
&& !empty ( $_POST['password']) && trim($_POST['password'])!==''
&& !empty ( $_POST['confirm_password']) && trim($_POST['confirm_password'])!==''
|| !empty ( $_POST['subject1']) || trim($_POST['subject1'])!==''
|| !empty ( $_POST['subject2']) || trim($_POST['subject2'])!==''
|| !empty ( $_POST['subject3']) || trim($_POST['subject3'])!==''
|| !empty ( $_POST['subject4']) || trim($_POST['subject4'])!==''
)
{

$gender=$_POST['gender'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$age=$_POST['age'];
$address=$_POST['address'];
$cellnumber=$_POST['cellnumber'];
$course="BS in Education (Major in English)";
$password=$_POST['password'];
$email=$_POST['email'];
$subject1=$_POST['subject1'];
$subject2=$_POST['subject2'];
$subject3=$_POST['subject3'];
$subject4=$_POST['subject4'];


//$q=$_POST['question'];
//$a=$_POST['answer'];
//echo $s.$q.$a;
//$quizz->add_question('1',$s,$q,$a);
//header("location:login_quizz.php");

//time stamp
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
//echo $date_modified;
$student_id2=$quizz->student_enroll($gender,$fname,$lname,$age,$address,$cellnumber,$course,$password,$email,$subject1,$subject2,$subject3,$subject4,$date_modified);
$_SESSION['login'] = true;
$_SESSION['student_id2']=$student_id2;	


header("location:enroll_thankyoupage.php?s=$student_id2");

}



else
$err_msg="Check the fields!";
}


//no answer
else
$err_msg="Check the fields!";

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

      .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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
          </button >
       <a class="navbar-brand" href="home.php"><img src="logo1.png" style="width:90px;height:30px"></img></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="login_student.php">Student</a></li>
            <li><a href="login_instructor.php">Faculty</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<br>
<br>


	
	
	   <form class="form-signin" role="form" method='post' action=''>
		      <h2 class="form-signin-heading">Student Enrollment</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->
	<div class="btn-group" data-toggle="buttons">
                  <label for="'.$radio.'" class="btn btn-primary">
                    <input class="form-control" type="radio"  value="Male" name="gender">Male</button>
					</label>
					
					<label for="'.$radio.'" class="btn btn-primary">
                    <input class="form-control" type="radio"  value="Female" name="gender">Female</button>
        </label>
				  </div>
<br>
<br>

        <input type="text" id="inputPassword" class="form-control" placeholder="First Name" required name='fname' value=''>
		 <br>

        <input type="text" id="inputPassword" class="form-control" placeholder="Last Name" required name='lname' value=''>
		 <br>

        <input type="text" id="inputPassword" class="form-control" placeholder="Age" required name='age' value=''>
		 <br>
	

		         <input type="text" id="inputPassword" class="form-control" placeholder="Cellnumber" required name='cellnumber' value=''>
		 <br>
		 

			
					         <input type="text" id="inputPassword" class="form-control" placeholder="Permanent Address" required name='address' value=''>
		 <br>
		
		         <input type="email" id="inputPassword" class="form-control" placeholder="Email" required name='email' value=''>
		 <br>
		 <br>
		 
		 

			
					 					         <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password' value=''>
		 <br>
		 
		 		 					         <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required name='confirm password' value=''>
			 <br>
			
						 <p class="lead">
			 Subjects:
			 </p>
			         <div class="checkbox">
          <label>
            <input type="checkbox"  Name="subject1" value="subject1">PROF ED 2: Facilitating Learning
          </label>
		  <br>
		            <label>
            <input type="checkbox"  Name="subject2" value="subject2">STRAT 4: Principles of Teaching 1
          </label>
		  	  <br>
		            <label>
            <input type="checkbox"  Name="subject3" value="subject3">STRAT 5: Developmental Training 1
          </label>
		  	  <br>
		            <label>
            <input type="checkbox"  Name="subject4" value="subject4">ECON 1: Basic Economics Taxation, Agrarian Reform
          </label>
        </div>
			 <br>
			 
<p class="lead">
Course: BS in Education (Major in English)
</p>


								 <br>
								 <div class="well">
								<p>
								By clicking the Submit button below, I consent to representatives of e-Palm Online contacting me about EDUCATIONAL OPPORTUNITIES via email, text or phone including my mobile phone provided above. I understand that my consent is not a requirement for purchase.I understand that I may withdraw my consent at any time.
								<p>
						
								 </div>
							
								 								<?php						
								echo "<span style='color: red'>".$err_msg."</span>";
								?>
								  <br>
								  <br>
				
        <button class="btn btn-lg btn-primary btn-block" type="submit">SUBMIT</button>

							<br>
		
    <p><a href="login_student.php" class="btn btn-success btn-block" role="button">Go to sign in page</a></p>

				<br>
				<br>

      </form>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



	
	
	
	
	
	
	
	
  </body>
</html>