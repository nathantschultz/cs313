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

<h1>Content Pages:</h1>
<a href="http://cs313.nathantschultz.com/index.php?action=create_content">Create New Page</a>
<?php echo buildListOfContent();?>
</section>
