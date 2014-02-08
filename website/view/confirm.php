<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">
<h1>Are you sure?</h1>	
<p><a href="http://www.nathantschultz.com/index.php?action=delete_content&amp;id=<?php echo $_SESSION['confirm_id'];?>">Delete</a></p>
<p><a href="http://www.nathantschultz.com/index.php?action=list_content">Cancel</a></p>
</section>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>
