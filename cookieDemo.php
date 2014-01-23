<?php
if (isset($_COOKIE['count'])){
	
} else {
	setcookie("count", 0, time()+600);
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
	
	$_COOKIE["count"] += 1; 
	
	echo $_COOKIE["count"]; 
	
	?>
		
		
		
	</body>
</html>
		
		