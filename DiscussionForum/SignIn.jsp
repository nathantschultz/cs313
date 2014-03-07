<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Sign In</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Welcome</h1>
	<form action="SignIn" method="post" >
		<label>Username:</label>
		<input type="text" name="username"></input>
		
		<label>Password:</label>
		<input type="password" name="password"></input>
		<input type="submit" value="submit"></input>
	</form>
	
</body>
</html>