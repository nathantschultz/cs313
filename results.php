<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>Your Information</h1>
		
		<?php
		echo "Name: " . $_POST["name"] . "<br />";
		echo "Email: " . $_POST["email"]. "<br />";
		echo "Major: " . $_POST["major"]. "<br />";
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
