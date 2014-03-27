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



	<?php $linkId = $_SESSION['linkId'];
		$pages = getContent($linkId);
		
		$selected = null;
	?>


	<h1>Edit a Post</h1>
	
	<form id="contentCreator" method="post" action="http://recipe.nathantschultz.com/index.php" enctype="multipart/form-data">
		<h2>Title:</h2>
		<input type="text" name="title" value="<?php foreach($pages as $page){ echo $page['title'];} ?>" required /><br>
		
		<h2>Cooking Time:</h2>
		<input type="text" name="cooking_time" value="<?php foreach($pages as $page){ echo $page['cooking_time'];} ?>" required /><br />
				
		
		<h2>Difficulty:</h2>
		<input type="radio" name="difficulty" value="easy" id="dif1" <?php foreach ($pages as $page){if ($page['difficulty'] == "easy"){echo "checked='checked'";}}?>>Easy<br>
		<input type="radio" name="difficulty" value="medium" id="dif2" <?php foreach ($pages as $page){if ($page['difficulty'] == "medium"){echo "checked='checked'";}}?>>Medium<br>
		<input type="radio" name="difficulty" value="hard" id="dif3" <?php foreach ($pages as $page){if ($page['difficulty'] == "hard"){echo "checked='checked'";}}?>>Hard<br>
	
		<h2>Ingredients:</h2>
		<textarea name="ingredients" rows="10" cols="120"><?php foreach($pages as $page){ echo $page['ingredients'];} ?></textarea>
			
		<h2>Directions:</h2>
		<textarea name="directions" rows="10" cols="120"><?php foreach($pages as $page){ echo $page['directions'];} ?></textarea>
			
		<h2>Image:</h2>
		<?php 
			foreach($pages as $page){
				if ($page['image_name']){
					echo "<img src='/images/" . $page['image_name'] . "' alt='" . $page['title'] . "' >" . "<br />";
				}
			}
		?>

		<h2>New Image (leave blank to use existing image):</h2>
		<input type="file" name="file1"/><br />
			
		<br>		
		<h2>Update Post:</h2>
		
		<input type="hidden" name="image_name" id='image_name' value="<?php foreach($pages as $page){ echo $page['image_name'];} ?>"> 

		<input type="submit" name="save" id="save" value="Save Changes">
		<input type="hidden" name="action" id="action" value="update_content">
		<input type="hidden" name="oldTitle" id="oldTitle" value="<?php foreach($pages as $page){ echo $page['title'];} ?>">
	</form>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://recipe.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://recipe.nathantschultz.com/js/registrationRules.js"></script>
