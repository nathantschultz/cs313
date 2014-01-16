<!DOCTYPE html>
<html>
<head>
	<title>Practice</title>
</head>

<body>
<?php

$list = ("friend" => "Jane", "hello" => "world");

foreach ($list as $key => $value){
	echo "<div id='$key'>DIV $value <div>";
}
	
?>
</body>

</html>