<%@ page language="java" contentType="text/html; charset=US-ASCII"
    pageEncoding="US-ASCII"%>
    <%@ page import="java.util.List" %>
    <%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=US-ASCII">
<title>View Posts</title>
<link rel="stylesheet" type="text/css" href="style.css"></link>
</head>
<body>

<h1>Posts:</h1><br /><br />
	
	<c:forEach items="${posts}" var="post">

		${post}<br />
	</c:forEach>
<br />	
<a href="NewPost.jsp">Create New Post</a><br />
</body>
</html>