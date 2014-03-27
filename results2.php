<?php
session_start();

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
          <a class="navbar-brand" href="http://recipe.nathantschultz.com">CS 313</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://recipe.nathantschultz.com">Home</a></li>
            <li><a href="http://recipe.nathantschultz.com?action=assignments">Assignments</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase">


<div class="page-header">
		<br />
        <h1>Survey</h1>
      </div>









		<?php
			if (isset($_POST['voted'])){
				$voted = $_POST['voted'];
				$_SESSION['voted'] = $voted;
				echo "Vote Recorded.<br ?> <br />";
			}
			
			if ($file = fopen("file.txt", "r+")){
			} else {
				echo '<strong>Error reading file.</strong><br /><br />';
			}
		
			$lines = array();
			
		
			if ($file){
				$i = 0;
				while (!feof($file)){
					$lines[$i] = fgets($file);
					$i++;
				}
			}
					
			$labels = array();
			$labels[0] = "<strong>1. What is your favorite ice cream?</strong><br />Chocolate: ";
			$labels[1] = "Vanilla: ";
			$labels[2] = "Mint Chocolate Chip: ";
			$labels[3] = "Sherbet: ";
			$labels[4] = "<strong>2. What is your favorite operating system?</strong><br />Mac: ";
			$labels[5] = "Windows: ";
			$labels[6] = "Linux: ";
			$labels[7] = "DOS: ";
			$labels[8] = "<strong>3. What is your favorite mobile operating system?</strong><br />iOS: ";
			$labels[9] = "Windows Phone 8: ";
			$labels[10] = "Android: ";
			$labels[11] = "WebOS: ";
			$labels[12] = "<strong>4. What is your favorite browser?</strong><br />Internet Explorer: ";
			$labels[13] = "Safari: ";
			$labels[14] = "Chrome: ";
			$labels[15] = "Firefox: ";
			
			
			if (isset($_POST['ice'])){
				$p = $_POST['ice'];
				$lines[$p] += 1;
				$lines[$p] .= "\n";
			}
			if (isset($_POST['os'])){
				$n = $_POST['os'];
				$lines[$n] += 1;
				$lines[$n] .= "\n";
			}
			if (isset($_POST['phone'])){
				$a = $_POST['phone'];
				$lines[$a] += 1;
				$lines[$a] .= "\n";
			}			
			if (isset($_POST['browser'])){
				$w = $_POST['browser'];
				$lines[$w] += 1;
				$lines[$w] .= "\n";
			}
			
			$newTally = "";
			
			$j = 0;
			
			foreach ($lines as $line){
				echo $labels[$j] . $line . "<br/>";
				$j++;
				$newTally .= $line;
			}
			
			rewind($file);
		
			fwrite($file, $newTally);
			
			fclose($file);

			
		?>
		
		
		
		<a href="http://recipe.nathantschultz.com/survey.php">Back to survey</a>
	
	
	
	
	
	
	
	
	
	
	
	
	
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
    <script src="/docs-assets/js/holder.js"></script>
  </body>
</html>