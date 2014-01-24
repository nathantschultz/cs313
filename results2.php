<!DOCTYPE html>
<html>
	<head>
		<title>Results</title>
	</head>
	<body>
		<?php
			if (isset($_POST['voted'])){
				$_COOKIE['voted'] = $_POST['voted'];
			}
			
			/*
$file = fopen("file.txt", "r+");
		
			if ($file){
				while (!feof($file)){
					$line = fgets($file);
					
					print("$line <br/>");
				}
			}
		
		
			fwrite($file, "New Content");
			
			fclose($file);
*/

		?>
	</body>
</html>
