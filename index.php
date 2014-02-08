<?php
	/*
//Start session
	$lifetime = 0;
	session_set_cookie_params($lifetime, '/');
	
	if(!$_SESSION){
		session_start();
	}
*/

	require_once('../Database_Connections/recipe_db.php');
	require('model.php');
	require('helpers.php');
	
	// Get the action to perform
	if (isset($_POST['action'])) {
    	$action = cleanString($_POST['action']);
	} else if (isset($_GET['action'])) {
    	$action = cleanString($_GET['action']);
	} else {
    	$action = 'content';
	}
	
	
	// Get page id
	if (isset($_POST['page_id'])) {
    	$page_id = $_POST['page_id'];
	} else if (isset($_GET['page_id'])) {
    	$page_id = $_GET['page_id'];
	} else {
    	$page_id = 1;
	}
	
	
	// Determine action to take
	switch($action) {
		
		
		
		
		
		
		case 'assignments':
			header('Location: /view/assignments.php');
			break;
		case 'content':
		default:
			buildContent($page_id);
			break;		
	}
?>