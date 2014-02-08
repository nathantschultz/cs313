<!DOCTYPE html>
<html>
	<head>
		<title>Movies</title>
	</head>
	<body>
	
	<?php
	
	$mysqli = new mysqli("localhost", "php", "php-pass", "movies");
	
	if ($mysqli->connect_errno){
		echo "Failed to connnect to MySQL: " . $mysqli->connect_error;
	}
	
	$result = $mysqli->query("select * from actor");
		
		echo "<h1>Actors</h1>";
		
		while ($row = $result->fetch_assoc()){
			echo $row['name'] . "<br /><br />"; 
		}
	
	
	
	?>
	
	</body>
</html>