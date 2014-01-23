<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>Your Information</h1>
		
		<?php
		echo "Name: " . htmlspecialchars($_POST["name"]) . "<br />";
		echo "Email: " . htmlspecialchars($_POST["email"]). "<br />";
		echo "Major: " . htmlspecialchars($_POST["major"]). "<br />";
		echo "<br />Places visited:<br />";
		
		$places = htmlspecialchars($_POST["places"]);

		echo "<ul>";		
		foreach ($places as $place){
			echo "<li>$place</li>";
		}
		echo "</ul>";
		
		echo "Other Comments: " . htmlspecialchars($_POST["comments"]);
		
		?>
	</body>
</html>
