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

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 40px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 20px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 50px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
	  

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
    height: 60vh;
}
.fade-carousel .carousel-inner .item {
    height: 60vh;
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
    top: 55%;
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
    height: 50%;
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
  height: 60vh;
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
    .hero h1 { font-size: 1.5em; }    
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
       <a class="navbar-brand" href="#"><img src="logo1.png" style="width:90px;height:30px"></img></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="login_student.php">Student</a></li>
            <li><a href="login_instructor.php">Faculty</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<br>
<br>
		
		
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
			<a class="btn btn-lg btn-primary" href="student_enroll.php" role="button">Enroll now!</a>
        </hgroup>

      </div>
    </div> 
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>Enhanced online-mobile learning system</h1>        
             <h5>Participate online quizzes, exams, exercises, and discussions.</h5>
			 			<a class="btn btn-lg btn-primary" href="student_enroll.php" role="button">Enroll now!</a>
			 
        </hgroup>       
      </div>
    </div>

  </div> 
</div>
	
	<br>
		<br>
	<!--
	
			<div class="jumbotron">
			
		
        <h1>Your access to education!</h1>
        <p class="lead">New, handy, and mobile-first online learning experience.<br>Bringing an affordable yet quality education to everyone.</p>
        <a class="btn btn-large btn-success" href="student_enroll.php">Enroll now!</a>
      </div>
	  
	  -->

	  <div class="row">
	  
	
				 
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Student</h4>
                  <p>Be informed. Enroll anywhere, anytime. Participate online discussions, exercises, quizzes, and exams.Keep track of your grades and your academic progress.</p>
          <p><a class="btn" href="login_student.php">Click here to login »</a></p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
					     <div class="team-member">
						 
						 
						 
						 </div>
					
                </div>
				
	
				
				
                            <div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Faculty</h4>
          <p>Keep track of your classes. Create online discussions, exercises, quizzes, and exams. View your class list and submit grades. Add assessments.</p>
          <p><a class="btn" href="login_instructor.php">Click here to login »</a></p>

                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
				
				<div class="col-sm-4">
                    <div class="team-member">
                        <img src="documents/epalm3.jpg" class="img-responsive img-circle" alt="">
<br>                      
					  <h4>Our Story</h4>
          <p>Stories, announcements, and news are posted here</p>
		  <br> 
		  <br> 
          <p><a class="btn" href="http://epalm-online.blogspot.com/" target="_blank">Click here to see our blog page »</a></p>

                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
				
				
	
		
				</div>
				
				  <br>
	  <br>	
				

            <p>If you have general feedback, or if you have an idea or inquiries, please email us at:</p>
            <p><strong><a href="mailto:jauisland@gmail.com">question@e-palm.net</a></strong></p>
	
				
				  
	  <br>
	  <br>

  	  	  <br>
	  <br>
	  <footer>

        <hr>
        <div class="row">
            <div class="col-lg-12 footer-below">
               <p><a href="#">e-Palm Online</a> is a project maintained by <a href="#">e-Palm Inc</a>.
			   <br>
			   This has been currently pilot-tested by the online education program of <a href="#">Raise a Village Project Inc.</a>
			</p>
 
            </div>
        </div>

</footer>
	  

    </div><!-- /.container -->

	


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>