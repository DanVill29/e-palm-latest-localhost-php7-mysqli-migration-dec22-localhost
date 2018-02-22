<?php
session_start();
ob_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if(isset($_SESSION['student_id']))
{
$student_id=$_SESSION['student_id'];
}


if(isset($_SESSION['instructor_id']))
{
$instructor_id=$_SESSION['instructor_id'];
//echo $instructor_id;
}

$msg="";

if(isset($_POST['submit']))
{
//$feature_icon=$student_id.".jpg";
//$file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
//$upload_exts = end(explode(".", $_FILES["file"]["name"]));
//$upload_exts = end(explode(".", $feature_icon));



//$upload_extension =  explode(".", $feature_icon);
//$upload_extension = end($upload_extension);



if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
|| in_array($upload_exts, $file_exts))
{
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
/*
echo "Upload: " . $_FILES["file"]["name"] . "<br>";
echo "Type: " . $_FILES["file"]["type"] . "<br>";
echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
*/


if(isset($_SESSION['instructor_id']))
{
$_FILES["file"]["name"]="Instructor".$instructor_id.".jpg";

move_uploaded_file($_FILES["file"]["tmp_name"],
"upload/newupload/" .$_FILES["file"]["name"]);
}
else
{
$_FILES["file"]["name"]=$student_id.".jpg";
move_uploaded_file($_FILES["file"]["tmp_name"],
"upload/newupload/" .$_FILES["file"]["name"]);
}
/*
echo "Stored in: " .
"upload/newupload/" .'46';
*/
$msg="Successfully added!";

/*
move_uploaded_file($_FILES["file"]["tmp_name"],
"upload/newupload/" . $_FILES["file"]["name"]);
echo "<div class='sucess'>"."Stored in: " .
"upload/newupload/" . $_FILES["file"]["name"]."</div>";
*/


}


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
<br>

<?php
if(isset($_SESSION['instructor_id']))
{
$instructor_id=$_SESSION['instructor_id'];
//echo $instructor_id;

    echo "<p>";
	echo '<a href="instructor_portal.php" class="btn btn-primary btn-block" role="button">';
	echo "Back to home page";
	echo "</a>";
	echo "</p>";
}
else if(isset($_SESSION['student_id']))
{
    echo "<p>";
	echo '<a href="login_quizz2.php" class="btn btn-primary btn-block" role="button">';
	echo "Back to home page";
	echo "</a>";
	echo "</p>";

}


		  
?>

	   
	   <form class="form-signin" role="form" action="upload.php" method="post"
enctype="multipart/form-data">
	   
        <h2 class="form-signin-heading">Add/Update Profile Picture</h2>
		    <!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		-->

		<label for="file">Filename:</label>

<input type="file" name="file" id="file"><br>
	

        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Submit</button>
		<?php
echo $msg;
?>

		        				<br>

		

		
      </form>




	  
	  
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript

    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


  


  </body>
</html>


<style>
.sucess{
color:#088A08;
}
.error{
color:red;
}
</style>

