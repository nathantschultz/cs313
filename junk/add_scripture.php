<!DOCTYPE html>
<html>
	<head>
		<title>Add Scripture</title>
	</head>
	<body>
	
	<form action="scripture_result.php" method="post" >
	
	Book: <input type="text" name="book"><br />
	Chapter: <input type="text" name="chapter"><br />
	Verse: <input type="text" name="verse"><br />
	Content: <input type="text" name="content"><br />
	

	<?php
	
	$mysqli = new mysqli("localhost", "php", "php-pass", "scriptures");
	
	if ($mysqli->connect_errno){
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	}
	
	$topic = $mysqli->query("select * from Topics");
	
	while ($row = $topic->fetch_assoc()){
			echo "<input type='checkbox' name='topics[]' value='". $row['topics_id'] ."'>" . $row['topics_name'] . "<br />";
	}
	
	?>
	
		
	<input type="submit" value="submit">
	
	
	
	</form>
	
	
	
	
	</body>
</html>