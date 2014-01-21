<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>Your Information
		
		<?php
		echo "Name: " . $_POST["name"];
		echo "Email: " . $_POST["email"];
		echo "Major: " . $_POST["major"];
		echo "<br />Places visited:<br />";
		
		$places = $_POST["places"];

		echo "<ul>";		
		foreach ($places as $place){
			echo "<li>$place</li>";
		}
		echo "</ul>";
		
		echo "<br/>Other Comments:" . $_POST["commments"];
		
		?>
	</body>
</html>
