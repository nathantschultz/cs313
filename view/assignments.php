<?php
	// Display Header 
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>

<section class="content" id="home" >
	<?php 
	if(!isset($_SESSION['$alerts'])){
		$_SESSION['$alerts'] = false;
	}
	
	if($_SESSION['$alerts']){
		echo $_SESSION['$alerts'] . "<br />";
		$_SESSION['$alerts'] = "";  
	}
	?>



	<p><a href="http://recipe.nathantschultz.com/survey.php">Assignment #1: Survey</a></p>
	<p><a href="http://recipe.nathantschultz.com:8080/DiscussionForum/SignIn.jsp">JSP Forum</a></p>
	<p><a href="http://recipe.nathantschultz.com:8080/MovieTweets/">Movie Tweets using AJAX</a></p>




</section>
		

</body>
</html>
