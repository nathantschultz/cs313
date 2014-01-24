<?php
if (isset($_COOKIE['voted'])){
	$voted = $_COOKIE['voted'];
} else {
	$voted = false;
}

setcookie("voted", $voted, time()+600);

if ($voted) {
	header('Location: http://cs313.nathantschultz.com/results2.php');
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Survey</title>
	</head>
	<body>
		<h1>Survey</h1>	
		<form action="results2.php" method="post">
		1. What is your favorite ice cream?<br />	
		<input type="radio" name="ice" value="Chocolate">Chocolate<br/>
		<input type="radio" name="ice" value="Vanilla">Vanilla<br/>
		<input type="radio" name="ice" value="Mint Chocolate Chip">Mint Chocolate Chip<br/>
		<input type="radio" name="ice" value="Sherbet">Sherbet<br/>
		<br>
		2. What is your favorite operating system?<br />
		<input type="radio" name="os" value="Mac">Mac<br/>
		<input type="radio" name="os" value="Windows">Windows<br/>
		<input type="radio" name="os" value="Linux">Linux<br/>
		<input type="radio" name="os" value="DOS">DOS<br/>
		<br>
		3. What is your favorite mobile operating system?<br />
		<input type="radio" name="phone" value="iOS">iOS<br/>
		<input type="radio" name="phone" value="Windows Phone 8">Windows Phone 8<br/>
		<input type="radio" name="phone" value="Android">Android<br/>
		<input type="radio" name="phone" value="WebOS">WebOS<br/>
		<br>
		4. What is your favorite browser?<br />
		<input type="radio" name="browser" value="Internet Explorer">Internet Explorer<br/>
		<input type="radio" name="browser" value="Safari">Safari<br/>
		<input type="radio" name="browser" value="Chrome">Chrome<br/>
		<input type="radio" name="browser" value="Firefox">Firefox<br/>
		<br>
		<input type="hidden" name="voted" value="true">
		<input type="submit" value="Submit">
		</form>
		
		<a href="http://cs313.nathantschultz.com/results2.php">View Results</a>
	</body>
</html>