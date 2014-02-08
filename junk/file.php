
<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>File Page</h1>
	<?php
	
		//one string
		if ($count = file_get_contents("file.txt)"){
			echo $count;
		}
	
	
		//array of lines
		if ($contents = file("file.txt"){
			foreach ($contents as $value){
				echo "$value <br/>"
			}
		}
	
		//another way
		$file = fopen("file.txt", "r+");
		
		if ($file){
			while (!feof($file)){
				$line = fgets($file);
				print("$line <br/>");
			}
		}
	
	
		fwrite($file, "New Content");
		
		fclose($file);
	
	?>
		
		
		
	</body>
</html>
		
		