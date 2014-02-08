<?php   
	require_once('../Database_Connections/main_db.php');
	require('model.php');
	require('helpers.php');
	
	// Display Header
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>    
		   	
		   	<h1 id="welcome">404 Error: Page not found</h1>
	
<?php
	// Display Footer
	include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php';
?>