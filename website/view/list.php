<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">
<h1>Content Pages:</h1>
<a href="http://www.nathantschultz.com/index.php?action=create_content">Create New Page</a>
<?php echo buildListOfContent();?>
</section>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>
