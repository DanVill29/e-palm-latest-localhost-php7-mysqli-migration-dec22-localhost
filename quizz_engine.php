<?php
include_once 'db_connect.php';



class quizz_engine{



//Database connect ---------------------------------------------
public function __construct() 
{
$db = new db_connect();
}

// Getting session 
public function get_session()
{
return $_SESSION['login'];
}
// Logout 
public function user_logout()
{
$_SESSION['login'] = FALSE;
session_destroy();
}

public function studentperformance_subject($subject_id)
{
	$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo $subject_id.$quiz_id;
	$result3 = mysqli_query($conn,"SELECT * FROM quizz where subject='$subject_id'");
	$count3=mysqli_num_rows($result3);
	
if ($count3 > 0) {

$quizget = mysqli_fetch_array($result3);
$quiz_id=$quizget["quizz_id"];

	$result = mysqli_query($conn,"SELECT * FROM student left join subject on student.student_id=subject.student_id where subject.subject='$subject_id' order by student.student_id asc");
$count=mysqli_num_rows($result);


if ($count > 0) {

     // output data of each row
     while($row = mysqli_fetch_array($result)) {
		 //quiz score
		 
	 $student_id=$row["student_id"];
	 $result2 = mysqli_query($conn,"SELECT * from quiz_results left join subject on quiz_results.student_id=subject.student_id where subject.subject='$subject_id' and quiz_results.student_id=$student_id and quiz_results.quiz_id=$quiz_id");
	 $count2=mysqli_num_rows($result2);
	 $rowstatus='active';
	 if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
		//in danger score
		if($user_data2['score']==0)
		{
		$rowstatus='danger';
		}
		else if($user_data2['score']==$user_data2['total_questions'])
		{
		$rowstatus='success';
		}
	 }
	 else
	 {
	 $score='no answer yet';
	 $rowstatus='warning';
	 }
	 
	 //display
         echo "<tr class=$rowstatus ><td>" . $row["student_id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>" .$score. "</td></tr>";
     }

} 
else {
echo '<br>';
     echo "No students enrolled yet!";
}
	
}




else
{
echo 'No quiz added yet to a subject';

	$result = mysqli_query($conn,"SELECT * FROM student left join subject on student.student_id=subject.student_id where subject.subject='$subject_id' order by student.student_id asc");
	$count=mysqli_num_rows($result);

if ($count > 0) {

     // output data of each row
     while($row = mysqli_fetch_array($result)) {
		 //quiz score
		 
	 $student_id=$row["student_id"];
	 $result2 = mysqli_query($conn,"SELECT * from quiz_results left join subject on quiz_results.student_id=subject.student_id where subject.subject='$subject_id' and quiz_results.student_id='$student_id'");
	 $count2=mysqli_num_rows($result2);
	 $rowstatus='active';
	 if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
		//in danger score
		if($user_data2['score']==0)
		{
		$rowstatus='danger';
		}
		else if($user_data2['score']==$user_data2['total_questions'])
		{
		$rowstatus='success';
		}
	 }
	 else
	 {
	 $score='no answer yet';
	 $rowstatus='warning';
	 }
	 
	 //display
         echo "<tr class=$rowstatus ><td>" . $row["student_id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>" .'n/a'. "</td></tr>";
     }

} 
else {
echo '<br>';
     echo "No students enrolled yet!";
}


}

	

}


public function check_student_exist($student_id)
{

	
if($student_id==1
|| $student_id==2
|| $student_id==3
|| $student_id==4
)
{
return true;
}

else
{
	// Create connection
$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn,"SELECT * FROM student WHERE student_id= '$student_id'");
$count=mysqli_num_rows($result);

if($count==0)
{
return false;
}
else
return true;

}


}


public function check_instructor_exist($instructor_id,$password)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn,"SELECT * FROM instructor WHERE id='$instructor_id' and password='$password'");
$count=mysqli_num_rows($result);

if($count==0)
{
return false;
}
else
return true;

}


public function check_student_exist2($student_id,$password)
{
if($student_id==1
|| $student_id==2
|| $student_id==3
|| $student_id==4
)
{
return true;
}

else

{
	// Create connection
$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM student WHERE student_id='$student_id' and password='$password'";
$result = mysqli_query($conn, $sql);
$count=mysqli_num_rows($result);

if($count==0)
{
return false;
}

else
return true;
}

}

public function show_allsubjects($year_level)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

		 if($year_level==1)
		 	{
		 
	
	$result3 = mysqli_query($conn,"SELECT * FROM subject_info where year_level='$year_level' order by id asc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
		echo '<h4>'.'1st year subjects- 1st semester'.'</h4>'.'<hr>';
	     while($row = mysqli_fetch_array($result3)) {
		 
		 
		 		 
							
								  

		 
		 	 //display
         echo '<input type="checkbox"  Name="subject[]" value="'.$row['id'].'" >';
		 echo '<h4>'.$row['title'].'</h4>';
		 echo '<br>';
		 								     

       
       
		 
		 }
	}
	
	}
	
	
	
	
	
	else
	
	{
		 
	
	$result3 = mysqli_query($conn,"SELECT * FROM subject_info where year_level='$year_level' order by id asc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
		echo '<h4>'.'2nd year subjects- 1st semester'.'</h4>'.'<hr>';
	     while($row = mysqli_fetch_array($result3)) {
		 
		 
		 		 
							
								  

		 
		 	 //display
         echo '<input type="checkbox"  Name="subject[]" value="'.$row['id'].'" >';
		 echo '<h4>'.$row['title'].'</h4>';
		 echo '<br>';
		 								     

       
       
		 
		 }
	}
	
	}
	
	
	
	

}


public function show_allsubjects_enrolled($year_level,$student_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($year_level==2)
{
		 
	
	$result3 = mysqli_query($conn,"SELECT distinct(subject_id) FROM enrolled_subjects where student_id='$student_id' and year_level='2' order by id asc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {

		echo '<h4>'.'2nd year- 1st semester'.'</h4>';
	     while($row = mysqli_fetch_array($result3)) {
		 
		 
		 		 
				echo '<hr>';			
								  

		 
		 	 //display
   
		// echo '<h4>'.$row['subject_id'].'</h4>';
	echo '<a href="#">'.'<h4 class="page-title">'.$this->get_subject_title($row['subject_id']).'</h4>'.'</a>';
		 //echo '<h5>'.$this->get_subject_title($row['subject_id']).'</h5>';
		 echo '<br>';
		 echo '<a class="btn btn-xs btn-default" href="?gotoquiz='.$row['subject_id'].'">Quiz page!</a>';
		 	 		 echo '<br>';
			 echo '<a class="btn btn-xs btn-default" href="subject1b.php?subject='.$row['subject_id'].'">Subject page</a>';
		 								     
		 
		 						 echo '<br>';
			 echo '<a class="btn btn-xs btn-default" href="add_discussion_s.php?subject='.$row['subject_id'].'">See discussions</a>';
		 								     
       		     echo '<hr>';
				 

       
		 
		 }
	}
	
	else
		
		{
	
			 echo '<a href="enrollsubjects.php">ENROLL 2nd year-1st semester subjects!</a>';
			 echo '<br>';
			 

			
		}
}
else
{
		 
	
	$result3 = mysqli_query($conn,"SELECT distinct(subject_id) FROM enrolled_subjects where student_id='$student_id' and subject_id <> 0 and year_level='1' order by id asc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
		echo '<h4>'.'1st year subjects- 1st semester'.'</h4>';
	     while($row = mysqli_fetch_array($result3)) {

		 	 //display
echo '<hr>';
		// echo '<h4>'.$row['subject_id'].'</h4>';
		 echo '<a href="#">'.'<h4 class="page-title">'.$this->get_subject_title($row['subject_id']).'</h4>'.'</a>';
			 //echo '<h5>'.$this->get_subject_title($row['subject_id']).'</h5>';
		 echo '<br>';
			 echo '<a class="btn btn-xs btn-default" href="?gotoquiz='.$row['subject_id'].'">Quiz page</a>';
			 		 echo '<br>';
			 echo '<a class="btn btn-xs btn-default" href="subject1b.php?subject='.$row['subject_id'].'">Subject page</a>';
		 
		 						 echo '<br>';
			 echo '<a class="btn btn-xs btn-default" href="add_discussion_s.php?subject='.$row['subject_id'].'">See discussions</a>';
		 								     echo '<hr>';
       		     

       
       
		 
		 }
	}
	
	else
		
		{

			 echo '<a href="enrollsubjects.php">ENROLL 1st year-1st semester subjects!</a>';
			 echo '<br>';
			 

			
			
		}
	
	
}

	
	

	
	
	
	
	

	
	

	
	
	
	

}

private function get_subject_title($subject_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM subject_info where id='$subject_id'");
	$count3=mysqli_num_rows($result3);
	$row = mysqli_fetch_array($result3);
	return $row['title'];

}


// Getting session ---------------------------------------------
public function student_enroll($gender,$fname,$lname,$age,$address,$cellnumber,$course,$password,$email,$subject1,$subject2,$subject3,$subject4,$date_modified)
{
	$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"INSERT INTO student(student_id,gender,firstname,lastname,age,address,cellnumber,course,password,email,date_modified) values('','$gender','$fname','$lname','$age','$address','$cellnumber','$course','$password','$email','$date_modified')") or die(mysqli_error());
$result = mysqli_query($conn,"SELECT * FROM student order by student_id desc");
$count=mysqli_num_rows($result);
if($count>0)
{
$user_data = mysqli_fetch_array($result,MYSQLI_ASSOC);
$student_id2= $user_data['student_id'];
if($subject1 || $subject2 || $subject3 || $subject4)
{
mysqli_query($conn,"INSERT INTO subject(subject_id,subject,subject_name,student_id,date_modified) values ('','$subject1','Facilitating Learning','$student_id2','$date_modified')") or die(mysqli_error());
mysqli_query($conn,"INSERT INTO subject(subject_id,subject,subject_name,student_id,date_modified) values ('','$subject2','','$student_id2','$date_modified')") or die(mysqli_error());
mysqli_query($conn,"INSERT INTO subject(subject_id,subject,subject_name,student_id,date_modified) values ('','$subject3','','$student_id2','$date_modified')") or die(mysqli_error());
mysqli_query($conn,"INSERT INTO subject(subject_id,subject,subject_name,student_id,date_modified) values ('','$subject4','','$student_id2','$date_modified')") or die(mysqli_error());
}
return $student_id2;


}
}
public function student_enroll2($gender,$fname,$lname,$age,$address,$cellnumber,$course,$password,$email,$year_level,$date_modified)
{
$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"INSERT INTO student(student_id,gender,firstname,lastname,age,address,cellnumber,course,password,email,year_level,date_modified) values('','$gender','$fname','$lname','$age','$address','$cellnumber','$course','$password','$email','$year_level','$date_modified')");
$result = mysqli_query($conn,"SELECT * FROM student order by student_id desc");
$count=mysqli_num_rows($result);
if($count>0)
{
$user_data = mysqli_fetch_array($result);
$student_id2= $user_data['student_id'];
return $student_id2;

}
}

public function enroll_subjects($student_id,$year_level,$subject)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($year_level==1)
{
	$result3 = mysqli_query($conn,"SELECT * FROM enrolled_subjects where student_id='$student_id' and subject_id='$subject'");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 == 0) {
	mysqli_query($conn,"INSERT INTO enrolled_subjects(id,student_id,subject_id,year_level,semester) values ('','$student_id','$subject','1','1')") or die(mysqli_error());
	}
		 

}
else if($year_level==2)
{
	$result3 = mysqli_query($conn,"SELECT * FROM enrolled_subjects where student_id='$student_id' and subject_id='$subject'");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 == 0) {
	mysqli_query($conn,"INSERT INTO enrolled_subjects(id,student_id,subject_id,year_level,semester) values ('','$student_id','$subject','2','1')") or die(mysqli_error());
	}
}
}


// Getting session ---------------------------------------------
public function update_quiz($toshow,$toshowid)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"UPDATE quizz SET showscore='$toshow' WHERE quizz_id='$toshowid'");
}


// Getting session ---------------------------------------------
public function add_feedback($feedback,$quizz_id,$student_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	//echo 'asdas';
mysqli_query($conn,"UPDATE quiz_results SET feedback='$feedback' WHERE student_id=$student_id and quiz_id=$quizz_id");
}


// Update answers ---------------------------------------------
public function update_answer($updateans_id,$answerid,$student_id,$quiz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn,"UPDATE answer SET result='$updateans_id' WHERE answer_id='$answerid'");

//
$result20 = mysqli_query($conn,"SELECT * FROM answer WHERE student_id ='$student_id' and quizz_id='$quiz_id'");
$count20=mysqli_num_rows($result20);
if($count20>0)
{
while($user_data3 = mysqli_fetch_array($result20))
{
$question_id_array[]= $user_data3['question_id'];
}
}
$total_right=0;
$total_wrong=0;
foreach ($question_id_array as $value) {
$result2 = mysqli_query($conn,"SELECT * FROM answer WHERE student_id ='$student_id' and quizz_id='$quiz_id' and question_id='$value'");
$count=mysqli_num_rows($result2);
//echo $count;
if($count>0)
{
$user_data2 = mysqli_fetch_array($result2);
$result3=$user_data2['result'];
//echo 'adasdas'.$result3;
if($result3==0)
{
$total_wrong=$total_wrong+1;
//echo '<br>';
//echo 'Question #:'.$value;
//echo '<br>';
//echo 'Result #:'.'Wrong answer.';

}
else
{
$total_right=$total_right+1;
}
}

}
//echo $total_wrong.$total_right;
//update_answer
mysqli_query($conn,"UPDATE quiz_results SET score='$total_right', wrong_answer='$total_wrong' WHERE quiz_id='$quiz_id'
and student_id='$student_id'");


}

// Getting session ---------------------------------------------
public function add_discussion($subject,$name,$instructor_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
//$namef=mysqli_real_escape_string($name)
mysqli_query($conn,"INSERT INTO discussion(id,subject,name,added_by,date_modified) values('','$subject','$name','$instructor_id','$date_modified')") or die(mysqli_error());
}

// Getting session ---------------------------------------------
public function add_comment($name,$discussion_id,$by)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
mysqli_query($conn,"INSERT INTO comment(id,name,discussion_id,added_by,date_modified) values('','$name','$discussion_id','$by','$date_modified')") or die(mysqli_error());
}

//add grades
public function add_grades($student_id,$prelim,$midterm,$pre_final,$final,$subject,$periodtochange,$cleared)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//check if failed or not --3.0 above is failed


$result = mysqli_query($conn,"SELECT * FROM grades WHERE subject='$subject' and student_id='$student_id'");
$count=mysqli_num_rows($result);
if($count>0)
{
//$user_data = mysqli_fetch_array($result);
//$result3=$user_data['result'];
//mysqli_query($conn,"UPDATE grades SET prelim='$prelim',midterm='$midterm',prefinal='$pre_final',final='$final' WHERE subject='$subject' and student_id='$student_id'");
//echo 'naa';
if($periodtochange=='Prelim')
{
//echo $prelim;
mysqli_query($conn,"UPDATE grades SET prelim='$prelim',cleared='$cleared' WHERE subject='$subject' and student_id='$student_id'");
}
else if($periodtochange=='Midterm')
{
mysqli_query($conn,"UPDATE grades SET midterm='$midterm',cleared='$cleared' WHERE subject='$subject' and student_id='$student_id'");
}
else if($periodtochange=='Pre-Final')
{
mysqli_query($conn,"UPDATE grades SET prefinal='$pre_final',cleared='$cleared' WHERE subject='$subject' and student_id='$student_id'");
}
else if($periodtochange=='Final')
{
mysqli_query($conn,"UPDATE grades SET final='$final',cleared='$cleared' WHERE subject='$subject' and student_id='$student_id'");
}

}
else
{



mysqli_query($conn,"INSERT INTO grades(id,student_id,prelim,midterm,prefinal,final,subject,cleared) values('','$student_id','$prelim','$midterm','$pre_final','$final','$subject','$cleared')") or die(mysqli_error());
//echo 'walay sulod!';
}
}


// Getting session ---------------------------------------------
public function add_quiz($subject,$name,$quiztype,$quiz_time)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//check qtype
if($quiztype=='0')
{
$showscore='1';
$quiz_time='60';
}
else
{
$showscore='0';
}

//$result = mysqli_query($conn,"SELECT * FROM subject WHERE subject='$subject'");
//$count=mysqli_num_rows($result);
//if($count>0)
//{
mysqli_query($conn,"INSERT INTO quizz(quizz_id,subject,name,quiztype,showscore,quiz_time) values ('','$subject','$name','$quiztype','$showscore','$quiz_time')") or die(mysqli_error());
$result2 = mysqli_query($conn,"SELECT * FROM quizz order by quizz_id desc");
$user_data = mysqli_fetch_array($result2);
$quiz_id= $user_data['quizz_id'];



if($subject=='subject1')
{
	$subject='Facilitating Learning';
}

//send email notification to students
$subject ='e-Palm Online Notification: Newly added quiz for your subject: '.$subject;
//$subject ='e-Palm Online Notification';

//$to = 'Roldan.Villaber@SurveySampling.com';

//$recipients = array("jauisland@gmail.com","roldan.villaber@surveysampling.com");
//$to = implode(',', $recipients); ;


$to = 'jauisland@gmail.com';
/**/
$body = 'Dear student, '.'<br>'.
'<br>'.
'Your subject instructor has just added a new quiz. Make sure to check on it in your quiz page.'.
'<br>'.
'<br>'.
'http://www.e-palm.net/login_student.php'.
'<br>'.
'<br>'.
'Kind regards, '.
'<br>'.
'e-Palm Online Team';



//$body = 'Dear students';

$this->send_email($subject,$to,$body);





return $quiz_id;
//}
//else
//echo 'subject did not exist. use the correct subject name';
}



// Getting session ---------------------------------------------
public function add_question($qtype_id,$s,$q,$a)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($qtype_id==1)
{
mysqli_query($conn,"INSERT INTO question(question_id,title,question_type_id,quizz_id) values ('','$q','1','$s')") or die(mysqli_error());

$result = mysqli_query($conn,"SELECT * FROM question WHERE quizz_id=$s order by question_id desc");
$count=mysqli_num_rows($result);
if($count>0)
{
$user_data = mysqli_fetch_array($result);
$question_id= $user_data['question_id'];
mysqli_query($conn,"INSERT INTO question_values1(question_id,value,answer) values ('$question_id','$q','$a')") or die(mysqli_error());
}
}

else if($qtype_id==2)
{
mysqli_query($conn,"INSERT INTO question(question_id,title,question_type_id,quizz_id) values ('','$q','2','$s')") or die(mysqli_error());

$result = mysqli_query($conn,"SELECT * FROM question WHERE quizz_id=$s order by question_id desc");
$count=mysqli_num_rows($result);
if($count>0)
{
$user_data = mysqli_fetch_array($result);
$question_id= $user_data['question_id'];
mysqli_query($conn,"INSERT INTO question_values1(question_id,value,answer) values ('$question_id','$q','$a')") or die(mysqli_error());
mysqli_query($conn,"INSERT INTO question_enum_values(question_id,enum_value_id,name) values ('$question_id','','$a')") or die(mysqli_error());
return $question_id;
}
}

else if($qtype_id=='choice')
{
mysqli_query($conn,"INSERT INTO question_enum_values(question_id,enum_value_id,name) values ('$s','','$a')") or die(mysqli_error());
}
else
echo 'no qtype';

}


//Save answer 
public function save_qset($qf,$s,$q,$value)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
foreach ($qf as $value) {
mysqli_query($conn,"INSERT INTO qset(qset_id,student_id,quizz_id,question_id) values ('','$s','$q','$value')") or die(mysqli_error());
}

}


///array approach
public function get_all_questions_final($array_name2,$student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$array_name=array();
$array_name=$array_name2;
foreach ($array_name as $value) 
{
$result = mysqli_query($conn,"SELECT question_id FROM answer WHERE question_id = '$value' and student_id='$student_id'
and quizz_id='$quizz_id'");
$count=mysqli_num_rows($result);

if($count==0)
{
//echo '<br>';
//echo 'Question #:'.$value;
return $value;
}
//


}
echo 'No more questions!';
echo '<br>';
//echo 'Your test results:';
$this->show_answer_result($student_id,$quizz_id);


}


public function get_fquestions($question,$student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$fquestion_id_array=$question;

foreach ($fquestion_id_array as $value) {
return $value;
}
echo '<br>';
echo 'no more questions';
echo '<br>';
echo 'Your test results:';
echo '<br>';

$this->show_answer_result($student_id,$quizz_id);

}




public function get_all_questions_array($question,$student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$question_id_array2=array();
$question_id_array3=array();
$question_id_array2=$question;

foreach ($question_id_array2 as $value) {
//echo 'Question #:'.$value;
//echo '<br>';
}

foreach ($question_id_array2 as $value2) {
$result = mysqli_query($conn,"SELECT question_id FROM answer WHERE question_id = '$value2' and student_id='$student_id'");
$count=mysqli_num_rows($result);

if($count==0)
{
//echo '<br>';
//echo 'Question #:'.$value2;
echo '<br>';
//return $value2;
$question_id_array3[]= $value2;
}
}

foreach ($question_id_array3 as $value3) {
//echo 'FQuestion #:'.$value3;
echo '<br>';
}
return $question_id_array3;

}

///array approach
public function get_all_questions_quizz_array($student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn,"SELECT * FROM question WHERE quizz_id=$quizz_id order by question_id asc");
$count=mysqli_num_rows($result);

echo $count;
//1
if($count>0)
{
$result1 = mysqli_query($conn,"SELECT * FROM question WHERE quizz_id=$quizz_id");
while($user_data3 = mysqli_fetch_array($result1))
{
$question_id_array[]= $user_data3['question_id'];
}
}

//sort($question_id_array);
$question_id_array2=array();
$question_id_array2=$question_id_array;
//sort($question_id_array2);
shuffle($question_id_array2);
return $this->get_all_questions_array($question_id_array2,$student_id,$quizz_id);
/*
foreach ($question_id_array2 as $value) {
echo 'Question #:'.$value;
echo '<br>';
}
/*



/*
foreach ($question_id_array as $value) {
$result = mysqli_query($conn,"SELECT question_id FROM answer WHERE question_id = $value and student_id=$student_id");
$count=mysqli_num_rows($result);

if($count==0)
{
echo '<br>';
echo 'Question #:'.$value;
echo '<br>';
return $value;
}


}
echo 'no more questions';
echo '<br>';
echo 'Your test results:';
echo '<br>';
$this->show_answer_result($student_id,$quizz_id);
*/
}






public function get_all_questions_quizz($quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn,"SELECT question_id FROM question WHERE quizz_id=$quizz_id order by question_id asc");
$count=mysqli_num_rows($result);

if($count==0)
{
echo 'no quizz question yet';
}
else
$user_data = mysqli_fetch_array($result);
return $user_data['question_id'];
}


public function check_if_questionanswered_bystudent($student_id,$question_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn,"SELECT question_id FROM answer WHERE question_id = $question_id and result='1' and student_id=$student_id");
$count=mysqli_num_rows($result);

if($count==0)
{
return $question_id;
}
else
echo 'question is answered already!';
}

public function get_question_perquizz($student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$question_id=$this->get_all_questions_quizz_array($student_id,$quizz_id);
return $question_id;


}
public function get_question_type_id($question_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn,"SELECT question_type_id FROM question WHERE question_id = $question_id");
$user_data = mysqli_fetch_array($result);
return $user_data['question_type_id'];
}

public function get_questionvalue($question_id,$question_type_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//open end
if ($question_type_id==1)
{
$result = mysqli_query($conn,"SELECT value FROM question_values1 WHERE question_id = $question_id");
$user_data = mysqli_fetch_array($result);
echo $user_data['value'];

echo '<form action="" method="post">';
echo '<textarea name="answer" class="form-control">';
echo '</textarea>';
echo '<br>';
//echo '<input type="submit" value="Submit Answer" />';
//echo '<a href="index.php">'.'<input type="submit" value="Take" class="btn btn-success">'.'</a>';
echo '<input type="submit" value="Take" class="btn btn-success">';
echo '</form>';
}

//radio button
else 
{
$result = mysqli_query($conn,"SELECT value FROM question_values1 WHERE question_id = $question_id");
$user_data = mysqli_fetch_array($result);
echo htmlspecialchars($user_data['value']);
echo '<br>';


$result3 = mysqli_query($conn,"SELECT * FROM question_enum_values WHERE question_id = $question_id");
//check if no project for wire
$count=mysqli_num_rows($result3);

//echo $count;
if($count>0)
{
while($user_data = mysqli_fetch_array($result3))
{
$array_radio[]=$user_data['enum_value_id'];
}
}
echo '<form action="" method="post">';
$row=1;
shuffle($array_radio);

echo '<div class="btn-group" data-toggle="buttons">';
foreach($array_radio as $radio)
{
$result2 = mysqli_query($conn,"SELECT name FROM question_enum_values WHERE question_id = $question_id and enum_value_id=$radio");
$user_data2 = mysqli_fetch_array($result2);

echo '<label for="'.$radio.'" class="btn btn-primary">';

echo '<input class="form-control"  type="radio" name="quizz" value="'.$user_data2['name'].'" >';
echo htmlspecialchars($user_data2['name']);
echo '</label>';
}
echo '</div>'; 


echo '<div>';
echo '<br>';
echo '<br>';




//echo '<a href="index.php">'.'<input type="submit" value="Take" >'.'</a>';
echo '<input type="submit" value="Take" class="btn btn-success">';
echo '</div>';

echo '</form>';
}

}

//Save answer 
public function save_answer($ans,$question_id,$result,$student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
mysqli_query($conn,"INSERT INTO answer(answer_id,question_id,value,result,student_id,quizz_id,date_modified) values ('','$question_id','$ans','$result','$student_id','$quizz_id','$date_modified')") or die(mysqli_error());
}

//Check answer
public function check_answer($ans,$question_id,$qtype_id,$student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($qtype_id==1)
{
$result2 = mysqli_query($conn,"SELECT answer FROM question_values1 WHERE question_id = $question_id");
$user_data = mysqli_fetch_array($result2);
//echo 'correct answer:'.$user_data['answer'];
$correct_answer=$user_data['answer'];
}
else if($qtype_id==2)
{
$result2 = mysqli_query($conn,"SELECT answer FROM question_values1 WHERE question_id = $question_id");
$user_data = mysqli_fetch_array($result2);
//echo 'correct answer:'.$user_data['answer'];
$correct_answer=$user_data['answer'];
}

//check answer
if($ans==$correct_answer)
{

$this->save_answer($ans,$question_id,"1",$student_id,$quizz_id);
//echo 'correct answer';
header("location:?");

}
else
{
$this->save_answer($ans,$question_id,"0",$student_id,$quizz_id);
//echo 'wrong answer';
header("location:?");
}
}


//Check answer
public function show_answer_result($student_id,$quizz_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn,"SELECT * FROM answer WHERE student_id ='$student_id' and quizz_id='$quizz_id'");
$count2=mysqli_num_rows($result);




//echo $count;
if($count2>0)
{
//looking for quiz type
$quiztyperes = mysqli_query($conn,"SELECT * FROM quizz WHERE quizz_id='$quizz_id'");

while($user_data = mysqli_fetch_array($result))
{
$array_name1[]=$user_data['question_id'];
}

$total_right=0;
$total_wrong=0;
$quiztype = mysqli_fetch_array($quiztyperes);
$quiztypef = $quiztype['quiztype'];
//echo $quiztype;
//will hide score if quizz or exams
if($quiztypef=='1')
{
foreach ($array_name1 as $value) {
$result2 = mysqli_query($conn,"SELECT * FROM answer WHERE student_id ='$student_id' and quizz_id='$quizz_id' and question_id='$value'");
$count=mysqli_num_rows($result2);

//echo $count;
if($count>0)
{
$user_data2 = mysqli_fetch_array($result2);
$result3=$user_data2['result'];
//echo 'adasdas'.$result3;
if($result3==0)
{
$total_wrong=$total_wrong+1;
//echo '<br>';
//echo 'Question #:'.$value;
//echo '<br>';
//echo 'Result #:'.'Wrong answer.';

}
else
{
$total_right=$total_right+1;
//echo '<br>';
//echo 'Question #:'.$value;
//echo '<br>';
//echo 'Result #:'.'Correct answer.';


}
}

}



}
else
{
//will show score if exercise only
foreach ($array_name1 as $value) {
$result2 = mysqli_query($conn,"SELECT * FROM answer WHERE student_id ='$student_id' and quizz_id='$quizz_id' and question_id='$value'");
$count=mysqli_num_rows($result2);

//echo $count;
if($count>0)
{
$user_data2 = mysqli_fetch_array($result2);
$result3=$user_data2['result'];
//echo 'adasdas'.$result3;
if($result3==0)
{
$total_wrong=$total_wrong+1;
echo '<br>';
echo 'Question #:'.$value;
echo '<br>';
echo 'Result #:'.'Wrong answer.';

}
else
{
$total_right=$total_right+1;
echo '<br>';
echo 'Question #:'.$value;
echo '<br>';
echo 'Result #:'.'Correct answer.';


}
}

}


}






//end part
$this->save_student_resultsq($student_id,$quizz_id,$total_right,$total_wrong,$count2);

//hide scores

if($quiztypef=='0')
{
echo '<div class="alert alert-success" role="alert">';
echo '<strong>';
echo 'Well done! ';
echo '</strong>';
echo 'You have successfully answered all question in the quiz.';
echo  '</div>';


echo '<h1>';
echo 'Your score:'.$total_right;
echo '<br>';
echo 'Your wrong answers:'.$total_wrong;
echo '<br>';
echo 'Total questions:'.$count2;
echo '<br>';
echo '</h1>';



if(!$this->check_student_exist($student_id))
{
echo '<br>';
echo '<a href="instructor_portal.php">';
echo 'Back to home page!';
echo '</a>';
}

else
{
echo '<br>';
echo '<a class="btn btn-success" href="quizpage.php?subject=1">';
echo 'Back to home page!';
echo '</a>';
}

}

///
else

{
echo '<div class="alert alert-success" role="alert">';
echo '<strong>';
echo 'Well done! ';
echo '</strong>';
echo '</br>';
echo 'You have successfully answered all question in the quiz/exam. Your instructor will sooner post your scores in your subject-quiz page. 
Normally, it will be posted once all of the students have completed taking the quiz.Please check on it later. This approach is part of e-palm student fraud management.';
echo  '</div>';


if(!$this->check_student_exist($student_id))
{
echo '<br>';
echo '<a href="instructor_portal.php">';
echo 'Back to home page!';
echo '</a>';
}

else
{
echo '<br>';
echo '<a class="btn btn-success" href="quizpage.php?subject=1">';
echo 'Back to home page!';
echo '</a>';
}



}

				

}
}


//Save answer 
public function save_student_resultsq($student_id,$quizz_id,$total_right,$total_wrong,$count2)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Manila");
$d=time();
$date_modified=date("Y-m-d h:i:sa", $d);
mysqli_query($conn,"INSERT INTO quiz_results(id,student_id,quiz_id,score,wrong_answer,total_questions,date_modified) values ('','$student_id','$quizz_id','$total_right','$total_wrong','$count2','$date_modified')") or die(mysqli_error());
}

//Save answer 
public function progresbar_byquiz($student_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
		/*checking and getting quiz by student and subject */
$result = mysqli_query($conn,"SELECT * FROM quiz_results WHERE student_id='$student_id'");
$count=mysqli_num_rows($result);
return $count;
}


//Save answer 
public function show_quizzes($subject,$student_id)
{
		$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$question_id_array=array();

//echo $subjectf;
	
		/*checking and getting quiz by student and subject */
$result = mysqli_query($conn,"SELECT * FROM enrolled_subjects WHERE subject_id = '$subject' and student_id='$student_id'");
$count=mysqli_num_rows($result);

if($count>0)
{
//echo 'good-this student is a enrolled student for subject1';
$result1 = mysqli_query($conn,"SELECT * FROM quizz WHERE subject = '$subject' order by quizz_id asc");
$count1=mysqli_num_rows($result1);



if($count1>0)
{


//loop and check if quiz are answered already
 while($row = mysqli_fetch_array($result1)) {

 
 
 
 $r=$row['quizz_id'];
 $showscore=$row['showscore'];
  //classifying quizz type
 $quiztypef=$row['quiztype'];
 //echo  $quiztypef;
 if($quiztypef=='0')
 {
 $quiztypeff='an exercise'.'<br>'.' only.';
 $disabled="";
 echo  $disabled;
 }
 else
 {
 $quiztypeff='quiz/exam.'.'<br>'.'Make sure to answer '.'<br>'.'it correctly.';
 $disabled="disabled='disabled'";
 //echo  $disabled;
 }


// echo '<br>';
 
 $result2 = mysqli_query($conn,"SELECT * FROM answer WHERE quizz_id ='$r' and student_id='$student_id'");
 $count2=mysqli_num_rows($result2);
 if($count2>0)
{





echo '<br>';
//echo "<button class='btn btn-lg btn-success btn-block'  echo $disabled; name='submit2' type='submit'>";
echo '<div class="well">';

echo 'Quiz ID:'. $r.'<br>'.' is already answered.';
echo '<br>';
echo 'This quiz is '.$quiztypeff;
echo '<br>';
//will show score only if exercise
if($quiztypef=='0' &&  $showscore=='1' )
{
	 $result2 = mysqli_query($conn,"SELECT * from  enrolled_subjects left join  quiz_results on quiz_results.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject' and quiz_results.student_id='$student_id'
	 and quiz_results.quiz_id='$r'");
	 $count2=mysqli_num_rows($result2);
	  if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
	 }
	 echo '<br>';
	 echo 'Score: '.$score;
	 echo '<br>';
	  echo '<br>';
	 echo '<a class="btn btn-primary " href="?retest='.$r.'">'.'Retest'.'</a>';
	 echo '<br>';
	 echo 'Time completed: '.'<br>'.$user_data2['date_modified'];
}
//for exam/quizz that faculty allows the scores to show
else if($quiztypef=='1' && $showscore=='1')
{
	 $result2 = mysqli_query($conn,"SELECT * from quiz_results left join enrolled_subjects on quiz_results.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject' and quiz_results.student_id='$student_id'
	 and quiz_results.quiz_id='$r'");
	 $count2=mysqli_num_rows($result2);
	  if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
	 }
	 echo '<br>';
	 echo 'Score: '.$score;
	 echo '<br>';
	 echo 'Time completed: '.'<br>'.$user_data2['date_modified'];

}
else
//hide scores in quizz and exam
{
	 echo 'Your scores '.'<br>'.'will be posted sooner.';
	 echo '<br>';
	 echo 'Time completed: '.'<br>'.$user_data2['date_modified'];
}




if($user_data2['feedback']=="") 
{
// echo "</button>";
echo "</div>";
	 echo '<br>';
	 		  //display
		 echo '<div class="alert alert-info alert-dismissable">';
	 echo "Teacher's feedback: ";
	 echo "<br>";
	 echo "'"."No feedback yet!"."'";
		 echo "</div>";
		
		 
		 }
		 
		 else
{
	// echo "</button>";
	 echo "</div>";
	 echo '<br>';
	 		  //display
		 echo '<div class="alert alert-info alert-dismissable">';
	 echo "Teacher's feedback: ";
	 echo "<br>";
	 echo "'".$user_data2['feedback']."'";
		 echo "</div>";
	


}


}
else
{
$question_id_array[]= $row['quizz_id'];
/*
echo 'You can take this quizz. Quiz:'.$row['quizz_id'];
echo '<br>';
echo "<button class='btn btn-lg btn-primary btn-block' name='submit' value='$r' type='submit'>";
echo "</button>";
echo '<br>';
*/
}

 }
 
 
echo '</section>'; 
 }
else
{
echo 'No quiz added yet!';
 }

}
 else
 {
 echo 'Please ENROLL to this subject. Contact the administrator';
 }
 
//print the question id 
if($question_id_array <> '')
{
echo '<hr>';
echo '<br>';
echo '<p class="lead">';
echo 'II. Available quizzes/exams/exercises:';
echo "</p>";
echo '<br>';
echo '<a class="page-scroll" href="#done">Go to Already done</a>';
echo '<section id="Available" class="Available">';
echo '<br>';


$x=0;
foreach ($question_id_array as $value) {

// looking for quizz type
	 $result20 = mysqli_query($conn,"SELECT * from quizz where quizz_id='$value'");
	 $count20=mysqli_num_rows($result20);
	  if ($count20 > 0) {
	 $user_data20=mysqli_fetch_array($result20);
	 $quiztypeffb=$user_data20['quiztype'];
	  if($quiztypeffb=='0')
 {
 $quiztypeff='an exercise '.'<br>'.'only';
 }
 else
 {
 $quiztypeff='quiz/exam.'.'<br>'.'Make sure to '.'<br>'.'answer it correctly.';
 }
	 
	 }


/**/
//display only the first quizz
if($x==0)
{

//Modular approach costumize such that when student grade failed in that period, he/she can't take the proceeding quizzes.
//check the grades cleared value, if 1 , will block, else will allow.
	 $result50 = mysqli_query($conn,"SELECT * from grades where student_id='$student_id'");
	 $count50=mysqli_num_rows($result50);
	  if ($count50 > 0) {
	 $user_data50=mysqli_fetch_array($result50);
	 $cleared=$user_data50['cleared'];
	 if($cleared=='1')
	 {
	 	 $quiz_control="";
		 $quiz_control_msg="";
		 

	 }
	 else
	 {
	 	 $quiz_control="disabled='disabled'";
		 $quiz_control_msg='<div class="alert alert-info alert-dismissable">'."We noticed that you have difficulties for this subject. Please check your grades.
		 Please also consult your instructor. For you to be able to proceed to this course, please make sure to study properly and 
		 answer each quizzes and exams properly. Ask your instructor for his/her clearance. Based only on your instructor's clearance, we will enable you to proceed."."</div>";;
		 

	 }
	 }
	 else
	 {
	 	 	 $quiz_control="";
			 $quiz_control_msg="";
	 }
	 





echo '<br>';
echo "<button class='btn btn-lg btn-primary btn-block' name='submit' value='$value' type='submit' echo $quiz_control>";
echo 'Take a quiz!';
echo "</button>";



echo '<br>';
echo  $quiz_control_msg;
echo '<br>';
//echo '<p class="lead">';
echo 'Quiz'.$value.':';
echo '<br>';
echo 'This quiz is '. $quiztypeff;
//echo '</p>';

echo '<br>';

}
else
{
echo '<br>';


echo "<button class='btn btn-lg btn-default btn-block' disabled='disabled' type='submit'>";
echo 'Take a quiz!';
echo "</button>";
echo '<br>';
//echo '<p class="lead">';
echo 'Quiz'.$value.':';
echo '<br>';
echo 'This quiz is '. $quiztypeff;
//echo '</p>';


echo '<br>';
//echo $err_msg;
echo '<br>';
}

$x++;

}
echo '</section>'; 

}



}

public function delete_question($qidtodelete)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"DELETE FROM question WHERE question_id='$qidtodelete'");
}

public function delete_multiplechoice($deletenumid)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"DELETE FROM question_enum_values WHERE enum_value_id='$deletenumid'");
}


public function update_multiplechoice($c,$editnumid)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"UPDATE question_enum_values SET name='$c' WHERE enum_value_id='$editnumid'");
}


public function delete_quiz($q)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"DELETE FROM quizz WHERE quizz_id='$q'");
}

public function show_allquizzid()
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM quizz order by quizz_id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		 
		 if($row["subject"]=='subject1')
		 {
		 $subjectname='Facilitating Learning';
		 }
		 else
		 {
		 $subjectname="";
		 }
		 
		 	 //display
         echo "<tr class='active' ><td>".$row["quizz_id"]."<a href='?editquiz=".$row["quizz_id"]."'>"." Edit Questions.|"."</a>"."<a href='?deleteq=1&&showscoreid=".$row["quizz_id"]."'>"." Delete this quiz.|"."</a>"."<a href='?showscoreid=".$row["quizz_id"]."'>"." Show score"."</a>"."|"."<a href='?hidescoreid=".$row["quizz_id"]."'>"."hide score"."</a>"."</td><td>" .$subjectname. "</td><td>" .$row["name"]. "</td></tr>";

		 }
	}

}



public function show_allquestion_inaquiz($quiz_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM question where quizz_id='$quiz_id' order by question_id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		    $question_id=$row["question_id"];
		 	$result4 = mysqli_query($conn,"SELECT * FROM question_values1 where question_id='$question_id' order by question_id desc");
	        $row2 = mysqli_fetch_array($result4);
			$title=$row2["value"];
			$ans=$row2["answer"];
			//echo $title.$ans;
		 
		 
		 
		 	 //display
         echo "<tr class='active' ><td>".$row["question_id"]."<a href='?editquiz=".$row["question_id"]."&&qtype=".$row["question_type_id"]."&&qtitle=".urlencode($row2["value"])."&&answer=".urlencode($row2["answer"])."'>"." Edit Question.|"."</a>"."<a href='?deleteq=".$row["question_id"]."'>"." Delete this question.|"."</a>"."</td><td>" .$row["title"]. "</td><td>" .$row["quizz_id"]. "</td></tr>";

		 }
	}

}


public function show_alldiscussion_inasubject($subject_id,$by)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	if($subject_id == "")
	{
			$result3 = mysqli_query($conn,"SELECT * FROM discussion order by id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		    //$id=$row["id"];
		 	//$result4 = mysqli_query($conn,"SELECT * FROM question_values1 where question_id='$question_id' order by question_id desc");
	        //$row2 = mysqli_fetch_array($result4);
		 

		 	 //display



		 //echo '<div class="well well-large">';
		  echo '<div id="editor" contenteditable="false" >';
		 //echo '<div class="alert alert-block">';
		  //echo '<div class="clearfix"">';
		 


         echo $row["name"];


		//echo "</div>";
		echo "</div>";
        echo "<br>";
				 //echo "<br>";
		 //echo "<br>";
		 echo 'Time added:';
		 echo '<br>';
		 echo $row["date_modified"];
		 echo '<br>';

		 echo "<a href='?editdisc=".$row["id"]."&&by=".$by."'>";
		 echo "<strong>";
		 echo "View and Add comment"."</a>";
		 echo "</strong>";
		// echo "<br>";
		 //echo "<br>";
		 echo "<br>";
		 echo '<br>';
		
		
		

		 }
	}
	else
	echo 'No discussion yet!';

	}
	
	else
	{
	
	$result3 = mysqli_query($conn,"SELECT * FROM discussion where subject='$subject_id' order by id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		    //$id=$row["id"];
		 	//$result4 = mysqli_query($conn,"SELECT * FROM question_values1 where question_id='$question_id' order by question_id desc");
	        //$row2 = mysqli_fetch_array($result4);
		 

		 	 //display



		 //echo '<div class="well well-large">';
		  echo '<div id="editor" contenteditable="false" >';
		 //echo '<div class="alert alert-block">';
		  //echo '<div class="clearfix"">';
		 


         echo $row["name"];


		//echo "</div>";
		echo "</div>";
        echo "<br>";
				 //echo "<br>";
		 //echo "<br>";
		 echo 'Time added:';
		 echo '<br>';
		 echo $row["date_modified"];
		 echo '<br>';

		 echo "<a href='?editdisc=".$row["id"]."&&by=".$by."'>";
		 echo "<strong>";
		 echo "View and Add comment"."</a>";
		 echo "</strong>";
		// echo "<br>";
		 //echo "<br>";
		 echo "<br>";
		 echo '<br>';
		
		
		

		 }
	}
	else
	echo 'No discussion yet!';
	}

}

public function show_alldiscussion_latest($subject_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM discussion where subject='$subject_id' order by id desc");
    $row = mysqli_fetch_array($result3);
	if($row >0)
	{
	echo '<div id="editor" contenteditable="false" >';
	echo $row["name"];
	echo '<br>';
	
	}
	else
	echo 'No discussion yet!';
	echo '</div>';
	echo '<br>';
	echo 'Time added:';
	echo '<br>';
	echo $row["date_modified"];
	

}

public function show_alldiscussion_bydiscid($id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM discussion where id='$id' order by id desc");
    $row = mysqli_fetch_array($result3);
	echo '<div id="editor" contenteditable="false" >';
	echo htmlspecialchars_decode($row["name"]);
	echo "</div>";
	echo "<br>";
	echo "Time added:";
	echo "<br>";
	echo $row["date_modified"];
	
	
}

public function show_allcomment_indisc($id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM comment where discussion_id='$id' order by id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		    //$id=$row["id"];
		 	//$result4 = mysqli_query($conn,"SELECT * FROM question_values1 where question_id='$question_id' order by question_id desc");
	        //$row2 = mysqli_fetch_array($result4);
		 if($row["added_by"]=='1'
		 || $row["added_by"]=='2'
		 || $row["added_by"]=='3'
		 || $row["added_by"]=='4'
		 )
		 {
		 $by="Subject Instructor";
		 }
		 else{
		 $by=$row["added_by"];
		 
		 	$result6 = mysqli_query($conn,"SELECT * FROM student where student_id='$by'");
			$count6=mysqli_num_rows($result6);
				if ($count6 > 0) {
				$row6 = mysqli_fetch_array($result6);
				$by=$row6["firstname"]." ".$row6["lastname"];
				}
			

		 
		 }

		 
	
		 
		 
		  //display
	     echo '<div id="editor" contenteditable="false" >';
		// echo "'";
         echo htmlspecialchars_decode($row["name"]);
		 //echo "'";
		 echo "</div>";
		 //echo "<br>";
		 echo "<br>";
		 echo "Added by:";
		 echo "<br>";
		 echo $by;
		 echo "<br>";
		 echo "<br>";
		 echo "Time added:";
		 echo "<br>";
		 echo $row["date_modified"];
		 echo "<br>";
		 echo "<br>";
		 
		 
		 
		 
		 }
	}
	else
echo 'No comment yet!';
}





public function show_allquizzid_indropdwon()
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM quizz order by quizz_id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		 $qid=$row['quizz_id'];
		 //echo $qid;
		 $name=$row['name'];
		 		 $subject=$row['subject'];
		
		 	 //display
		  echo "<option name='subject' value='$qid' >";
		  echo 'Quiz ID: '.$qid.' | '.'Description: '.$name.' | '.'Subject: '.$subject;
		  echo "</option>";
			 
			 


		 }
	}

}


public function show_allstudentinasubject_indropdwon()
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM enrolled_subjects order by subject_id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		 $student_id=$row['student_id'];
		 
		 	$result4 = mysqli_query($conn,"SELECT * FROM student WHERE student_id='$student_id'");
			$row2 = mysqli_fetch_array($result4);
			$fullname=$row2['firstname']." " .$row2['lastname'];
	

		 
		 
		 
		 //echo $qid;
		 $name=$row['name'];
		 		 $subject=$row['subject_id'];
				 
	
				 
		
		 	 //display
		  echo "<option name='student' value='$student_id' >";
		  echo 'Student ID: '.$student_id.' | '.'Full Name: '.$fullname.' | '.'Subject: '.$subject;
		  echo "</option>";
			 
			 


		 }
	}

}




//show answer per quiz
public function show_answer($student_id,$quizz_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM answer WHERE student_id='$student_id' and quizz_id='$quizz_id' order by answer_id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {
		 $qid=$row["question_id"];
		 
		 //getting question id, value, and its correct answer
		 	$result4 = mysqli_query($conn,"SELECT * FROM question_values1 WHERE question_id='$qid'");
			$count4=mysqli_num_rows($result4);
		 	if ($count4 > 0) {
			$row2 = mysqli_fetch_array($result4);
			$qval=$row2["value"];
			$qcorrectans=$row2["answer"];
			$qres=$row["result"];
			if($qres==1)
			{
			$qresf='correct answer';
			}
			else
			$qresf='wrong answer';
			
			
			
			}
		 
		 
		 	 //display
         echo "<tr class='active' ><td>".$row["answer_id"]."</td><td>" .htmlspecialchars($qval). "</td><td>".htmlspecialchars($qresf)."</td><td>".htmlspecialchars($qcorrectans)."</td><td>" .htmlspecialchars($row["value"])."<a href='?student=$student_id&&showanswers=$quizz_id&&updateanswer=1&&answerid=".$row["answer_id"]."'>"." | mark as correct"."</a>". "<a href='?student=$student_id&&showanswers=$quizz_id&&updateanswer=0&&answerid=".$row["answer_id"]."'>"."| mark as wrong"."</a>". "</td></tr>";

		 }
	}

}

//show answer per quiz
public function show_grades($student_id,$subject)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

	$result3 = mysqli_query($conn,"SELECT * FROM grades WHERE student_id='$student_id' and subject='$subject'order by id desc");
	$count3=mysqli_num_rows($result3);
	
	if ($count3 > 0) {
	
	     while($row = mysqli_fetch_array($result3)) {

		 
		 	 //display
         echo "<tr class='active' ><td>".$row["prelim"]."</td><td>" .$row["midterm"]. "</td><td>".$row["prefinal"]."</td><td>"."<strong>".$row["final"]."</strong>"."</td></tr>";

		 }
	}
	else
	echo 'no grades yet.';

}








//retest exercises
public function retest($student_id,$quiz_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"DELETE FROM answer WHERE student_id='$student_id' and quizz_id='$quiz_id'");
mysqli_query($conn,"DELETE FROM quiz_results WHERE student_id='$student_id' and quizz_id='$quiz_id'");
}

public function showquizzes_persubject($subject_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$result3 = mysqli_query($conn,"SELECT * FROM quizz where subject='$subject_id' order by quizz_id desc");
	$count3=mysqli_num_rows($result3);
	
if ($count3 > 0) {
//$quizget = mysqli_fetch_array($result3);
//$quiz_id=$quizget["quizz_id"];

 while($row = mysqli_fetch_array($result3)) {
 	 $quiz_id=$row["quizz_id"];
	  	 $name=$row["name"];

 
 
		  echo "<option name='quizz_id' value='$quiz_id' >";
		  echo 'Quiz ID: '.$quiz_id.' | '.'Description: '.$name.' | ';
		  echo "</option>";
 
 }

}
}

public function manage_enrollment()
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT * FROM student where activate='0' order by student_id desc");
    $count=mysqli_num_rows($result);


if ($count > 0) {

     // output data of each row
     while($row = mysqli_fetch_array($result)) {
		 $student_id=$row["student_id"];
		 $activate=$row["activate"];
		 $activate_msg='';
		 
		 //Activate student as officially enrolled
		 	

			 if($activate=='0')
			 {
			 $activate_msg='| '.'<a href="?activate=1&student_id='.$student_id.'">'.'Accept Enrollment'.'</a>';
			 //echo $cleared_msg;
			 			 $send_email='| '.'<a href="mailto:'.$row["email"].'">'.'Send Email'.'</a>';
			 }
			 
			 //echo $activate_msg.'<br>';
			 
			 			          echo "<tr class='active' ><td>" . $student_id.$activate_msg. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>".$row["email"].$send_email."</td><td>".$row["cellnumber"]."</td></tr>";
								  

			 
	 }
	
}


}


public function show_studentperformance_subject($subject_id,$quiz_id)
{
			$conn = mysqli_connect("localhost", "root", "", "epalmnet_epalm");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$cleared_msg="";
//echo $subject_id.$quiz_id;
	$result3 = mysqli_query($conn,"SELECT * FROM quizz where subject='$subject_id' order by quizz_id desc");
	$count3=mysqli_num_rows($result3);
	
if ($count3 > 0) {

if($quiz_id=="")
{
$quizget = mysqli_fetch_array($result3);
$quiz_id=$quizget["quizz_id"];
}


	$result = mysqli_query($conn,"SELECT * FROM student left join enrolled_subjects on student.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject_id' 
	and student.activate='1'
	order by student.student_id desc");
$count=mysqli_num_rows($result);


if ($count > 0) {

     // output data of each row
     while($row = mysqli_fetch_array($result)) {
		 $student_id=$row["student_id"];
		 $send_email='| '.'<a href="mailto:'.$row["email"].'">'.'Send Email'.'</a>';
		 $call='<a href="tel:'.$row["cellnumber"].'">Click Here To Call</a>';



	 		//checking if cleared or not, to proceed 
		$result50 = mysqli_query($conn,"SELECT * from grades where student_id='$student_id'");
		$count50=mysqli_num_rows($result50);
			 if ($count50 > 0) {
			 $user_data50=mysqli_fetch_array($result50);
			 $cleared=$user_data50['cleared'];
			 
			 
			 
			 
			 if($cleared=='0')
			 {
			 $cleared_msg='| '.'<a href="?clearance=1&subject='.$subject_id.'&student_id='.$student_id.'">'.'Allow to proceed!'.'</a>';
			 //echo $cleared_msg;
				 
			 }
			 else
			 $cleared_msg="";

			 
			 }
	 
	 
	 
	 
	 
	 
	 $result2 = mysqli_query($conn,"SELECT * from quiz_results left join enrolled_subjects on quiz_results.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject_id' and quiz_results.student_id=$student_id and quiz_results.quiz_id=$quiz_id");
	 $count2=mysqli_num_rows($result2);
	 $rowstatus='active';
	 if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
	 

		

	 
	 
	 
	 
	 
	 
	 
		//in danger score
		if($user_data2['score']==0)
		{
		$rowstatus='danger';
		}
		else if($user_data2['score']==$user_data2['total_questions'])
		{
		$rowstatus='success';
		}
		//echo 
			 //display
         echo "<tr class=$rowstatus ><td>" . $row["student_id"].$cleared_msg. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>" ."Quiz ID:".$quiz_id.' | '.$score."<a href='edit_answers.php?showanswers=".$quiz_id."&&student=".$row["student_id"]."&&answers_id=".$user_data2["id"]."'>" ." | show answers"."</a>"."</td><td>".$row["email"]."| ".$send_email.$row["cellnumber"]."| ".$call."</td></tr>";

	 }
	 else
	 {
	 $score='no answer yet';
	 $rowstatus='warning';
	 	 //display
		 
         echo "<tr class=$rowstatus ><td>" . $row["student_id"].$cleared_msg."</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>" ."Quiz ID: ".$quiz_id.' | '.$score."</td><td>".$row["email"].$send_email."| ".$row["cellnumber"]."| ".$call."</td></tr>";

	 }
	 
     }

} 
else {
echo '<br>';
     echo "No students enrolled yet!";
}
	
}




else
{
echo 'No quiz added yet to a subject';

	$result = mysqli_query($conn,"SELECT * FROM student left join enrolled_subjects on student.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject_id' order by student.student_id asc");
	$count=mysqli_num_rows($result);

if ($count > 0) {

     // output data of each row
     while($row = mysqli_fetch_array($result)) {
		 //quiz score
		 
	 $student_id=$row["student_id"];
	 $result2 = mysqli_query($conn,"SELECT * from quiz_results left join enrolled_subjects on quiz_results.student_id=enrolled_subjects.student_id where enrolled_subjects.subject_id='$subject_id' and quiz_results.student_id='$student_id'");
	 
	 
	 	 
		 $send_email='| '.'<a href="mailto:'.$row["email"].'">'.'Send Email'.'</a>';
		 $call='<a href="tel:'.$row["cellnumber"].'">Click Here To Call</a>';
	 
	 $count2=mysqli_num_rows($result2);
	 $rowstatus='active';
	 if ($count2 > 0) {
	 $user_data2=mysqli_fetch_array($result2);
	 $score=$user_data2['score'].'/'.$user_data2['total_questions'];
		//in danger score
		if($user_data2['score']==0)
		{
		$rowstatus='danger';
		}
		else if($user_data2['score']==$user_data2['total_questions'])
		{
		$rowstatus='success';
		}
	 }
	 else
	 {
	 $score='no answer yet';
	 $rowstatus='warning';
	 }
	 
	 //display
	 
	 /*
         echo "<tr class=$rowstatus ><td>" . $row["student_id"].$cleared_msg."</td><td>" . $row["firstname"]. " " . $row["lastname"]."</td><td>".$row["email"].$send_email."| ".$row["cellnumber"]."| ".$call."</td><td>" .'n/a'. "</td></tr>";
		 */
		 
		 
		          echo "<tr class=$rowstatus ><td>" . $row["student_id"].$cleared_msg. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>" ."Quiz ID:".$quiz_id.' | '.$score."</td><td>".$row["email"]."| ".$send_email.$row["cellnumber"]."| ".$call."</td></tr>";
		 
		 
     }

} 
else {
echo '<br>';
     echo "No students enrolled yet!";
}


}

	

	

}

public function send_email($subject,$to,$body){
		
			
			
			require 'class.phpmailer.php';
			try {
							$mail = new PHPMailer(true); 						  //New instance, with exceptions enabled
						
							$body      		  = preg_replace('/\\\\/','', $body); //Strip backslashes
							$mail->IsSMTP();                           			  // tell the class to use SMTP
							$mail->SMTPAuth   = true;                  			  // enable SMTP authentication
							$mail->Port       = 26;                    			  // set the SMTP server port
							$mail->Host       = "mail.e-palm.net"; 		  // SMTP server
							$mail->Username   = "admin@e-palm.net";        // SMTP server username
							$mail->Password   = "Jamie2025!";            			  // SMTP server password
						
							$mail->AddReplyTo("admin@e-palm.net","e-Palm Online");
						
							$mail->From       = "admin@e-palm.net";
							$mail->FromName   = "e-Palm Online";
							
							$mail->AddAddress($to);
							
							$mail->Subject  = $subject;
						
							//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
							$mail->WordWrap   = 80; 		// set word wrap
						
							$mail->MsgHTML($body);
						
							$mail->IsHTML(true); 			// send as HTML
						
							$mail->Send();
							
							return true;
												
							
			}
			catch (phpmailerException $e) {
												
							return false;
			}
			
			
		
		
	}





}
?>