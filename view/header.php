<?php
	require_once($_SERVER['DOCUMENT_ROOT']. '/../../Database_Connections/recipe_db.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/model.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/helpers.php');
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="A Recipe Blog">
	    <meta name="author" content="Nathan Schultz">
	    <link rel="shortcut icon" href="/docs-assets/ico/favicon.png">
	
	    <title>The Recipe Blog</title>
	
	    <link href="/css/style.css" rel="stylesheet">
	</head>

	<body>
		<div class="header">
			<h1><a href="http://recipe.nathantschultz.com">The Recipe Blog</a></h1>
			<ul>
				<li>
				<?php 
					if (!isset($_SESSION['login'])){
						$_SESSION['login'] = false;
					}
				
					if ($_SESSION['login']){
						echo "<a href='http://recipe.nathantschultz.com/index.php?action=profile'>Profile</a></li>";
						echo "<li><a href='http://recipe.nathantschultz.com/index.php?action=logout'>Log Out</a>";	
					} else {
						echo "<a href='http://recipe.nathantschultz.com/index.php?action=login'>Login</a>";
					}?>
				</li>
			
				<li><a href="http://recipe.nathantschultz.com?action=assignments">Assignments</a></li>
				
				
				
				<li>
					<form id="search" method="post" action="http://recipe.nathantschultz.com/index.php">
					    <input type="text" name="searchTerm" id="search" placeholder="Search">
					    <input type="submit" name="submit" id="submit" value="Search">
					    <input type="hidden" name="action" value="search">
					</form>
				</li>
				
				<li><strong>Recipes:</strong></li>
				
				<?php echo buildNav();?>
			</ul>
		</div>