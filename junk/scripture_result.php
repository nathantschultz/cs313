<!DOCTYPE html>
<html>
	<head>
		<title>Result Scripture</title>
	</head>
	<body>	

		
	<?php
	
	$query_string ="insert into scriptures (book, chapter, verse, content) values ('" . $_POST['book']. "', " . $_POST['chapter']. ", " . $_POST['verse']. ", '" . $_POST['content']."')";
	
	foreach ($_POST['topics'] as $topic){
		
	}
	
	$query_string2 ="insert";
	
	$mysqli = new mysqli("localhost", "php", "php-pass", "scriptures");
	
	if ($mysqli->connect_errno){
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	}
	
	$insert = $mysqli->query($query_string);
	$insert = $mysqli->query($query_string2);

	
	$display = $mysqli->query("select * from Scriptures");
	
	while ($row = $display->fetch_assoc()){
			echo "id: " . $row["id"] . " book: " . $row["chapter"] . " verse: " . $row["verse"] . " content: " . $row["content"] . "<br /><br />";
	}
	
	?>
		
	
	
	
	</body>
</html>