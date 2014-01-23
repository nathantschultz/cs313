<?php
if (isset($_COOKIE['count'])){
	
} else {
	setcookie("count", $x, time()+600);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>Cookie Page</h1>
	<?php
	
	$_COOKIE["$x"] += 1; 
	
	echo $_COOKIE["$x"]; 
	
	?>
		
		
		
	</body>
</html>
		
		