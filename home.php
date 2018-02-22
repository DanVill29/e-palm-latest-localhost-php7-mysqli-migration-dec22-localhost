<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Landing Page - e-Palm</title>

    <!-- Bootstrap Core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	<style type="text/css">


	  /*
Fade content bs-carousel with hero headers
Code snippet by maridlcrmn (Follow me on Twitter @maridlcrmn) for Bootsnipp.com
Image credits: unsplash.com
*/

/********************************/
/*       Fade Bs-carousel       */
/********************************/
.fade-carousel {
    position: relative;
    height: 85vh;
}
.fade-carousel .carousel-inner .item {
    height: 85vh;
}
.fade-carousel .carousel-indicators > li {
    margin: 0 2px;
    background-color: #f39c12;
    border-color: #f39c12;
    opacity: .7;
}
.fade-carousel .carousel-indicators > li.active {
  width: 10px;
  height: 10px;
  opacity: 1;
}

/********************************/
/*          Hero Headers        */
/********************************/
.hero {
    position: absolute;
    top: 45%;
    left: 50%;
    z-index: 3;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    text-shadow: 1px 1px 0 rgba(0,0,0,.75);
      -webkit-transform: translate3d(-50%,-50%,0);
         -moz-transform: translate3d(-50%,-50%,0);
          -ms-transform: translate3d(-50%,-50%,0);
           -o-transform: translate3d(-50%,-50%,0);
              transform: translate3d(-50%,-50%,0);
}
.hero h1 {
    font-size: 2em;    
    font-weight: bold;
    margin: 0;
    padding: 0;
}

.fade-carousel .carousel-inner .item .hero {
    opacity: 0;
    -webkit-transition: 5s all ease-in-out  .1s;
       -moz-transition: 5s all ease-in-out .1s; 
        -ms-transition: 5s all ease-in-out .1s; 
         -o-transition: 5s all ease-in-out .1s; 
            transition: 5s all ease-in-out 1s; 
}
.fade-carousel .carousel-inner .item.active .hero {
    opacity: 1;
    -webkit-transition: 5s all ease-in-out .1s; 
       -moz-transition: 5s all ease-in-out .1s; 
        -ms-transition: 5s all ease-in-out .1s; 
         -o-transition: 5s all ease-in-out .1s; 
            transition: 5s all ease-in-out .1s; 
}

/********************************/
/*            Overlay           */
/********************************/
.overlay {
    position: absolute;
    width: 100%;
    height: 55%;
    z-index: 2;
    background-color: #080d15;
    opacity: .7;
}

/********************************/
/*          Custom Buttons      */
/********************************/
.btn.btn-lg {padding: 10px 40px;}
.btn.btn-hero,
.btn.btn-hero:hover,
.btn.btn-hero:focus {
    color: #f5f5f5;
    background-color: #1abc9c;
    border-color: #1abc9c;
    outline: none;
    margin: 20px auto;
}

/********************************/
/*       Slides backgrounds     */
/********************************/
.fade-carousel .slides .slide-1, 
.fade-carousel .slides .slide-2,
.fade-carousel .slides .slide-3 {
  height: 85vh;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.fade-carousel .slides .slide-1 {
  background-image: url(documents/h1.jpg); 
}
.fade-carousel .slides .slide-2 {
  background-image: url(documents/h2.jpg);
}


/********************************/
/*          Media Queries       */
/********************************/
@media screen and (min-width: 800px){
    .hero { width: 980px; }    
}
@media screen and (max-width: 500px){
    .hero h1 { font-size: 2.5em; }    
}


    </style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <a class="navbar-brand topnav" href="home.php"><img src="logo1.png" style="width:90px;height:30px"></img></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#story">OUR STORY</a>
                    </li>
                    <li>
                         <a class="page-scroll" href="#student">STUDENT</a>
                    </li>
                    <li>
                                  <a class="page-scroll" href="#teacher">FACULTY</a>
                    </li>
					                    <li>
                              <a class="page-scroll" href="#blog">BLOG</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
		  <section id="enroll" class="enroll">
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
		
	<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="8000" id="bs-carousel">
  <!-- Overlay   <div class="overlay"></div> -->


  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>

  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
           <h1>Education in the palm of your hands!</h1>       
            <h5>Connect now to the new, online and mobile-friendly learning system.</h5>
			<a class="btn btn-lg btn-primary" href="student_enroll2.php" role="button">Enroll now!</a>
        </hgroup>

      </div>
    </div> 
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>Enhanced online-mobile learning system</h1>        
             <h5>Participate online quizzes, exams, exercises, and discussions.</h5>
			 			<a class="btn btn-lg btn-primary" href="student_enroll2.php" role="button">Enroll now!</a>
			 
        </hgroup>       
      </div>
    </div>

  </div> 
</div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
	
    <!-- /.intro-header -->
	
	</section>
	
	  <section id="story" class="story">
    <div class="content-section-c">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">OUR STORY</h2>
					<h3 class="section-heading">What is e-Palm Online?</h3>
					  <p class="lead">This is our new version of a mobile-first and online learning system.This is a web application tool for students and instructors.</p>
					  
					  <p class="lead">This is designed so that students can now easily participate to their online discussions, exercises, quizzes, and exams. At the same time, this is a helpful tool for instructors where they can monitor students progress as well as to put up online discussions, exercises, quizzes, and exams.</p>
					  
					  
               		   <p><a target="_blank" class="btn btn-default btn-lg" href="http://epalm-online.blogspot.com/">Learn more about us »</a></p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="documents/BookPoppingOutOfTablet-reduced.jpg" alt="">
                </div>
            </div>
				<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->
		
					

    </div>
		</section>

	
	
	

    <!-- Page Content -->
	  <section id="student" class="student">
	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
               
					<hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                     <h2 class="section-heading">STUDENTS</h2>
					<h3 class="section-heading">Learning anytime and anywhere.</h3>
					 <p class="lead">Be informed. Enroll anywhere, anytime. Participate online discussions, exercises, quizzes, and exams.Keep track of your grades and your academic progress.</p><br>
                <p><a class="btn btn-default btn-lg" href="login_student.php">Click here to login »</a></p>
				
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="documents/epalm1.jpg" alt="">
                </div>
            </div>
							<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->

    </div>
	</section>
    <!-- /.content-section-a -->

	
	
		  <section id="teacher" class="teacher">
    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">FACULTY</h2>
					<h3 class="section-heading">Class management anytime and anywhere.</h3>
					  <p class="lead">Keep track of your classes.Create online discussions,exercises,quizzes,and exams.View your class list and submit grades.Add assessments.</p><br>
                <p><a class="btn btn-default btn-lg" href="login_instructor.php">Click here to login »</a></p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="documents/epalm2.jpg" alt="">
                </div>
            </div>
				<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->
		
					

    </div>
		</section>

    <!-- /.content-section-b -->

	
			  <section id="blog" class="blog">
    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Blog</h2>
                    <p class="lead">Stories, announcements, and news are posted here</p>
						   <p><a target="_blank" class="btn btn-default btn-lg" href="http://epalm-online.blogspot.com/">Our blog page »</a></p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="documents/epalm3.jpg" alt="">
                </div>
				

            </div>
							<br>
				<br>
				<br>
				<br>

		<a class="btn btn-default page-scroll" href="#enroll">Back to Top</a>

        </div>
        <!-- /.container -->

    </div>
	</section>
    <!-- /.content-section-a -->

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect now to e-Palm:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="mailto:jauisland@gmail.com" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">gmail</span></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/pages/E-Palm-Online/339954186176836" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
			
		

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
<div class="col-lg-12 footer-below">
               <p><a href="#">e-Palm Online</a> is a project maintained by <a href="#">e-Palm Inc</a>.
			   <br>
			   This has been currently pilot-tested by the online education program of <a href="#">Raise a Village Project Organization Inc.</a>
			</p>
 
            </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="dist/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script>
	
		    <!-- Scrolling Nav JavaScript -->
    <script src="dist/js/jquery.easing.min.js"></script>
    <script src="dist/js/scrolling-nav.js"></script>

</body>

</html>
