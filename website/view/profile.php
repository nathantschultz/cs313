<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="content">
<h1>Profile</h1>

<?php
	$id = $_SESSION['userId'];

	echo buildUserProfile($id);

	if ($_SESSION['admin']){
		echo buildAdminProfile();
	}
?>

<p><a href="http://cs313.nathantschultz.com/index.php?action=logout">Log out</a></p>
</section>