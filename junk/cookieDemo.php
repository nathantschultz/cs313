<?php
if (isset($_COOKIE['count'])){
	$x = $_COOKIE['count'];
} else {
	$x = 0;
}

$x++;

setcookie("count", $x, time()+600);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Results Page</title>
		
	</head>
	<body>
		<h1>Cookie Page</h1>
	<?php
	
	echo $_COOKIE["count"]; 
	
	?>
		
		
		
	</body>
</html>
		
		