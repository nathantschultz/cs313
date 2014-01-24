<?php
	// Start session management with a persistent cookie
	//$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
	$lifetime = 60 * 60 * 24;                      // per-session cookie
	session_set_cookie_params($lifetime, '/');	
	
	session_start();
		
   	if (isset($_SESSION['voted'])){
		$voted = $_SESSION['voted'];
	} else {
		$voted = false;
	}
	
	$_SESSION['voted'] = $voted;
	

	if ($voted) {
		header('Location: http://cs313.nathantschultz.com/results2.php');
	}

?>















<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A site for CS 313">
    <meta name="author" content="Nathan Schultz">
    <link rel="shortcut icon" href="/docs-assets/ico/favicon.png">

    <title>Nathan Schultz's Website</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dist/css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://cs313.nathantschultz.com">CS 313</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://cs313.nathantschultz.com">Home</a></li>
            <li><a href="http://cs313.nathantschultz.com/assignments.php">Assignments</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase">


<div class="page-header">
		<br />
        <h1>Survey</h1>
      </div>















		<form action="results2.php" method="post">
		<strong>1. What is your favorite ice cream?</strong><br />	
		<input type="radio" name="ice" value="0"> Chocolate<br/>
		<input type="radio" name="ice" value="1"> Vanilla<br/>
		<input type="radio" name="ice" value="2"> Mint Chocolate Chip<br/>
		<input type="radio" name="ice" value="3"> Sherbet<br/>
		<br>
		<strong>2. What is your favorite operating system?</strong><br />
		<input type="radio" name="os" value="4"> Mac<br/>
		<input type="radio" name="os" value="5"> Windows<br/>
		<input type="radio" name="os" value="6"> Linux<br/>
		<input type="radio" name="os" value="7"> DOS<br/>
		<br>
		<strong>3. What is your favorite mobile operating system?</strong><br />
		<input type="radio" name="phone" value="8"> iOS<br/>
		<input type="radio" name="phone" value="9"> Windows Phone 8<br/>
		<input type="radio" name="phone" value="10"> Android<br/>
		<input type="radio" name="phone" value="11"> WebOS<br/>
		<br>
		<strong>4. What is your favorite browser?</strong><br />
		<input type="radio" name="browser" value="12"> Internet Explorer<br/>
		<input type="radio" name="browser" value="13"> Safari<br/>
		<input type="radio" name="browser" value="14"> Chrome<br/>
		<input type="radio" name="browser" value="15"> Firefox<br/>
		<br>
		<input type="hidden" name="voted" value="true">
		<input type="submit" value="Submit">
		</form>
		
		<a href="http://cs313.nathantschultz.com/results2.php">View Results</a>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
    <script src="/docs-assets/js/holder.js"></script>
  </body>
</html>
