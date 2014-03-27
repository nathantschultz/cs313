<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
$uId = $_SESSION['confirm_id'];

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
<p><a href="http://recipe.nathantschultz.com/index.php?action=delete_user&amp;page_id=<?php echo $uId?>">Delete</a></p>
<p><a href="http://recipe.nathantschultz.com/index.php?action=profile">Cancel</a></p>
</section>