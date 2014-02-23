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

<h1>Results:</h1>


<?php 
	$searchTerm = $_SESSION['searchTerm'];
	echo buildSearchResults($searchTerm);
?>

</section>
