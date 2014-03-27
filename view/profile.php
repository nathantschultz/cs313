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
	
<h1>Profile</h1>

<?php
	$User_id10 = $_SESSION['userId'];

	echo buildUserProfile($User_id10);


	if (isset($_SESSION['admin'])){
		if ($_SESSION['admin']){
			echo buildAdminProfile();
		}
	}
?>

<p><a href="http://recipe.nathantschultz.com/index.php?action=logout">Log out</a></p>
</section>

