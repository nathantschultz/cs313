<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>

<section class="content">
	<?php 
	if(!isset($_SESSION['$alerts'])){
		$_SESSION['$alerts'] = false;
	}
	
	if($_SESSION['$alerts']){
		echo $_SESSION['$alerts'] . "<br />";
		$_SESSION['$alerts'] = "";  
	}
	?>

	<h1>Create a Content Page in HTML</h1>
	
	<form id="contentCreator" method="post" action="http://cs313.nathantschultz.com/index.php" enctype="multipart/form-data">
		<h2>Title:</h2>
		<input type="text" name="title" required /><br />
		
		<h2>Cooking Time:</h2>
		<input type="text" name="cooking_time" required /><br />
		
		<h2>Difficulty:</h2>
		<input type="radio" name="difficulty" value="easy" checked="checked" >Easy<br>
		<input type="radio" name="difficulty" value="medium">Medium<br>
		<input type="radio" name="difficulty" value="hard">Hard<br>
	
		<h2>Ingredients:</h2>
		<textarea name="ingredients" rows="10" cols="120">Enter the ingredients here.</textarea>
			
		<h2>Directions:</h2>
		<textarea name="directions" rows="10" cols="120">Enter the directions here.</textarea>
			
		<h2>Image:</h2>
		<!-- <input type="text" name="image_name" required /><br /> -->
		<input type="file" name="file1"/><br />	
			
		<br>		
		<h2>Create Post:</h2>
		<input type="submit" name="save" id="save" value="Save">
		<input type="hidden" name="action" id="action" value="save_content">
	</form>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/registrationRules.js"></script>