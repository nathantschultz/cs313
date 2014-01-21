<!DOCTYPE html>
<html>
	<head>
		<title>Form Page</title>
		
	</head>
	<body>

		<h1>Our form</h1>
		
		<form action="results.php" method="post">
		Name:<input type="text" name="name"><br />
		Email:<input type="text" name="email"><br /> 
		Major:
		<input type="radio" name="major" value="Computer Science">Computer Science<br/>
		<input type="radio" name="major" value="Web Development and Design">Web Development and Design<br/>
		<input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br/>
		<input type="radio" name="major" value="Computer Engineering">Computer Engineering<br/>
		<br>
		Places I have visited:
		<input type="checkbox" name="places" value="North America">North America<br/>
		<input type="checkbox" name="places" value="South America">South America<br/>
		<input type="checkbox" name="places" value="Europe">Europe<br/>
		<input type="checkbox" name="places" value="Asia">Asia<br/>
		<input type="checkbox" name="places" value="Australia">Australia<br/>
		<input type="checkbox" name="places" value="Africa">Africa<br/>
		<input type="checkbox" name="places" value="Antarctica">Antarctica<br/>
		<br>
		Any other comments?
		<input type="textarea" name="comments"><br/>
		<input type="submit" value="Submit">
		</form>



	</body>
</html>
