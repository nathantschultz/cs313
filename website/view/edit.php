<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">

	<?php $linkId = $_SESSION['linkId'];
		//get content id
		$contentId = getContentIdFromLinkId($linkId);
		
		$pages = getContent($contentId);
		$headers = getLinks('header');
		$footers = getLinks('footer');
		
		$selected = null;
	?>


	<h1>Edit a Content Page in HTML</h1>
	
	<form id="contentCreator" method="post" action="http://www.nathantschultz.com/index.php">
		<h2>Title:</h2>
		<input type="text" name="title" value="<?php foreach($pages as $page){ echo $page['title'];} ?>" required /><br>
		
	
		<h2>Section:</h2>
		<textarea name="section" rows="10" cols="120"><?php foreach($pages as $page){ echo $page['section'];} ?></textarea>
			
		<h2>Aside1:</h2>
		<textarea name="aside1" rows="7" cols="120"><?php foreach ($pages as $page){ echo $page['aside1'];} ?></textarea>
			
		<h2>Aside2:</h2>
		<textarea name="aside2" rows="7" cols="120"><?php foreach ($pages as $page){ echo $page['aside2'];} ?></textarea>
			
		<h2>Navigation in Header or Footer:</h2>		
		<p><input type="radio" name="headerFooter" value="header" id='headerFooter1'
		<?php foreach ($headers as $head){
			if ($head['id'] == $linkId){
				$selected = $head['parent'];
				echo "checked='checked'";
			} 
		}?>> Header</p>	
		<p><input type="radio" name="headerFooter" value="footer" id='headerFooter2'
		<?php foreach ($footers as $foot){
			if ($foot['id'] == $linkId){
				$selected = $foot['parent'];
				echo "checked='checked'";
			} 
		}?>> Footer</p>
			
		<h2>Parent:</h2>
		<select name="parent" id="parent">
			<option value="0">None</option>
			<?php echo buildParents($selected); ?>
		</select>
		
		<br>		
		<h2>Create Content Page:</h2>
		<input type="submit" name="save" id="save" value="Save Changes">
		<input type="hidden" name="action" id="action" value="update_content">
		<input type="hidden" name="oldTitle" id="oldTitle" value="<?php foreach($pages as $page){ echo $page['title'];} ?>">
	</form>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://www.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://www.nathantschultz.com/js/registrationRules.js"></script>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>
