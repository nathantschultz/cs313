<!DOCTYPE html>
<html>
	<head>
		<title>Scriptures 2</title>
	</head>
	<body>
	
	<?php
	
	$mysqli = new mysqli("localhost", "php", "php-pass", "scriptures");
	
	if ($mysqli->connect_errno){
		echo "Failed to connnect to MySQL: " . $mysqli->connect_error;
	}
	
	$result = $mysqli->query("select * from Scriptures");
		
		echo "<h1>Scripture Resources</h1>";
		
		while ($row = $result->fetch_assoc()){
			echo "<strong>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - </strong>" . $row['content'] . "<br /><br />"; 
		}
	
	
	
	?>
	
	</body>
</html>