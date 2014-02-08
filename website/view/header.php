<?php 
	require_once($_SERVER['DOCUMENT_ROOT']. '/../Database_Connections/main_db.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/model.php');
	require_once($_SERVER['DOCUMENT_ROOT']. '/helpers.php');
	
	if(!$_SESSION){
		session_start();
   	}
?>

<!DOCTYPE html> 
<html>
    <head>            
        <script src="/javascript/html5_shiv.js"></script>
		<meta charset="utf-8"> 
		<meta name="author" content="Nathan Schultz">
		<link rel="shortcut icon" href="http://www.nathantschultz.com/images/computer.png"/>

		<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" media="only screen and (min-width:951px)"  href="http://www.nathantschultz.com/css/large.css" />
		<link rel="stylesheet" type="text/css" media="only screen and (min-width:601px) and (max-width:950px)"  href="http://www.nathantschultz.com/css/medium.css">
		<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:600px)"   href="http://www.nathantschultz.com/css/small.css">
        <title><?php 
				switch($_SESSION['title']){
			        case 'login':
			        	echo "Login - ";
						break;
					case 'create_account':
						echo "Create Account - ";
						break;
					case 'profile':
						echo "Profile - ";
						break;
					case 'delete_user':
						echo "Admin - ";
						break;
					case 'list_content':
						echo "Content List - ";
						break;
					case 'create_content':
						echo "Create Page - ";			
						break;
					case 'save_content';
						echo "Content List - ";
						break;
					case 'edit_content':
			    		echo "Edit - ";
			    		break;
			    	case 'delete_content':
			    		echo "Content List - ";
			    		break;
			    	case 'confirm_delete_content':
			    		echo "Confirm - ";
			    		break;	
			    	case 'content':
			    		echo getTitle($id). " - ";
						break;
				}?>Nathan T. Schultz</title>
    </head> 
    <body>
	<div id="wrapper">
	    <header>
			<nav>
				<!--logo-->
				<div><a href='http://www.nathantschultz.com/index.php' title='Home'><img src='/images/bar_left.svg' alt='Home'></a></div>
				<?php echo buildHeaderNav();?>						
				<li>
				<?php 
					if ($_SESSION['login']){
						echo "<a href='http://www.nathantschultz.com/index.php?action=profile'>Profile</a>";
					} else {
						echo "<a href='http://www.nathantschultz.com/index.php?action=login'>Login</a>";
					}?>
				</li></ul>
			</nav>
</header>
<br>
<?php 
echo $_SESSION['$alerts'];
$_SESSION['$alerts'] = "";  
?>