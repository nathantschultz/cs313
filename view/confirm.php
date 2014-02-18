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


<h1>Are you sure?</h1>	
<p><a href="http://cs313.nathantschultz.com/index.php?action=delete_content&amp;page_id=<?php echo $_SESSION['confirm_id'];?>">Delete</a></p>
<p><a href="http://cs313.nathantschultz.com/index.php?action=list_content">Cancel</a></p>
</section>
