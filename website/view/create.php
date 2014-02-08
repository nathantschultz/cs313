<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">

	<h1>Create a Content Page in HTML</h1>
	
	<form id="contentCreator" method="post" action="http://www.nathantschultz.com/index.php">
		<h2>Title:</h2>
		<input type="text" name="title" required /><br>
		
	
		<h2>Section:</h2>
		<textarea name="section" rows="10" cols="120">&lt;section&gt;&lt;p&gt;Enter the HTML for your section here. Leave blank to not include a section.&lt;/p&gt;&lt;/section&gt;</textarea>
			
		<h2>Aside1:</h2>
		<textarea name="aside1" rows="7" cols="120">&lt;aside id='userContent'&gt;&lt;p&gt;Enter the HTML for your first aside here. Leave blank to not include an aside.&lt;/p&gt;&lt;/aside&gt;</textarea>
			
		<h2>Aside2:</h2>
		<textarea name="aside2" rows="7" cols="120">&lt;aside&gt;&lt;p&gt;Enter the HTML for your first aside here. Leave blank to not include an aside.&lt;/p&gt;&lt;/aside&gt;</textarea>
			
		<h2>Navigation in Header or Footer:</h2>		
		<p><input type="radio" name="headerFooter" value="header" id="headerFooter1" checked="checked"> Header</p>	
		<p><input type="radio" name="headerFooter" value="footer" id="headerFooter2" > Footer</p>
	
		<h2>Parent:</h2>
		<select name="parent" id="parent" >
			<option value="0">None</option>
			<?php echo buildParents(); ?>
		</select>
		
		<br>		
		<h2>Create Content Page:</h2>
		<input type="submit" name="save" id="save" value="Save">
		<input type="hidden" name="action" id="action" value="save_content">
	</form>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://www.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://www.nathantschultz.com/js/registrationRules.js"></script>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>


