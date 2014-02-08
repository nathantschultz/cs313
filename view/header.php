<?php
	require_once($_SERVER['DOCUMENT_ROOT']. '/../Database_Connections/recipe_db.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/model.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/helpers.php');

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
			<h1><a href="http://cs313.nathantschultz.com">The Recipe Blog</a></h1>
			<ul>
				<li><a href="http://cs313.nathantschultz.com?action=assignments">Assignments</a></li>
				
				<li><strong>Recipes:</strong></li>
				<?php echo buildNav();?>
			</ul>
		</div>
		
