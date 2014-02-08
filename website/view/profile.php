<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">
<h1>Profile</h1>

<?php
	$id = $_SESSION['userId'];

	echo buildUserProfile($id);

	if ($_SESSION['admin']){
		echo buildAdminProfile();
	}
?>

<p><a href="http://www.nathantschultz.com/index.php?action=logout">Log out</a></p>
</section>


<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>
