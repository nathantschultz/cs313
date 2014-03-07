<%@ page language="java" contentType="text/html; charset=US-ASCII"
    pageEncoding="US-ASCII"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=US-ASCII">
<title>New Post</title>
</head>
<body>
<h1>Welcome, ${param.username}</h1><br />

<form name="postNote" method="post" action="CreatePost">
	<textarea rows="6" cols="35" name="postContent" id="postContent"></textarea>
	<input type="submit" value="Submit" /> 
</form>


<a href="LoadPosts">View Posts</a><br />
<a href="logout">Click to logout</a>
</body>
</html>