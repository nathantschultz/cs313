<?php

//Start session
	$lifetime = 0;
	session_set_cookie_params($lifetime, '/', 'cs313.nathantschultz.com');
	session_start();
	
	require_once('../Database_Connections/recipe_db.php');
	require_once('model.php');
	require_once('helpers.php');
	
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
		
		case 'create_account':
			
			header('Location: /view/createAccount.php');
			break;
		
		case 'add_account':
			$name = cleanString($_POST['name']);
			$email = cleanEmail($_POST['email']); 
			$password = $_POST['password'];
						
			$problems = array();
			
			if (empty($name)){
				$problems['name'] = ' Your name is required.<br>';
			}
			if (empty($email)){
				$problems['email'] = ' Please enter a correctly formatted email.<br>';
			}
			if (empty($password)){
				$problems['password'] = ' Your password is required.<br>';
			}
			
			if (strlen($password)<8 or strlen($password) > 20) {
				$problems['pLength'] = " Your password must have between 8 and 20 characters.";
  			}	
  			
  			if (searchForPerson($email)){
	  			$problems['error'] = " There is already an existing account with that email address.";
  			}		
				
			// If problems are found send them back to be fixed
			if (!empty($problems))
			{	
				foreach ($problems as $problem){
					$_SESSION['$alerts'] .= $problem;
				}
				header('Location: /view/createAccount.php');
			}
			
			$password = hashPassword($password);
					
			// If no problems, proceed with the database interaction
			if(empty($problems))
			{
				$insertresult = insertPerson($name, $email, $password);
				
				
				$userId = getUserId($email);
				
				
				// Test what was returned from the model
				if ($insertresult and $userId)
				{
					$_SESSION['userId'] = $userId;
					$_SESSION['login'] = true;
					$_SESSION['$alerts'] .= "Your account has been created."; 
					header('Location: /view/profile.php');
				} else {
					// it failed
					$_SESSION['$alerts'] .= "Sorry, an error occurred while attempting to create your account.";
					header('Location: /view/createAccount.php');
				}
			}
			break;
		
		case 'login':
				if ($_SESSION['login']){
					header('Location: /view/profile.php');
				} else {
					header('Location: /view/login.php');
				}
			break;
		
		case 'logout':
			$_SESSION = array();
			session_destroy();
			
			include $_SERVER['DOCUMENT_ROOT']. '/view/header.php';
			echo "<section class='content'>You have been logged out.</section>";
			break;
		
		case 'check_credentials':	
			//$_SESSION['alert'] = $email;
		 	$email = $_POST['email']; 
			$password = hashPassword($_POST['password']);										
		 												
		 	$key = checkCredentials($email, $password);											
		 	$userId11 = getUserId($email);
			$isAdmin = getIsAdmin($userId11);	
			
			
		 	if ($key and $userId11){
			 	//Open sesame
			 	$_SESSION['$alerts'] .= "Access Granted.";
			 	$_SESSION['login'] = true;
			 	$_SESSION['userId'] = $userId11;
			 	
			 	if($isAdmin){
			 		$_SESSION['admin'] = true;
			 	} else {
				 	$_SESSION['admin'] = false;
			 	}
			 	header('Location: /view/profile.php');
		 	} else {
			 	//You shall not pass!
			 	$_SESSION['$alerts'] .= "Access Denied.";
			 	header('Location: /view/login.php');
		 	}
			break;	
		case 'profile':
			if($_SESSION['login']){
				header('Location: /view/profile.php');
			} else {
				header('Location: /view/login.php');
			}
			break;
		
		case 'edit_user':
			if ($_SESSION['login']){
	    		$_SESSION['userId1'] = $_SESSION['userId'];
	    		if ($_SESSION['admin']){
					$_SESSION['userId1'] = $page_id;
	    		}
				header('Location: /view/edit_user.php');
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
			break;	
		
		case 'update_user':
			if ($_SESSION['login']){
	    		$admin1 = cleanString($_POST['adminSelected']);
	    		
				if ($_SESSION['admin'] and $admin1){
					$admin1 = true;
				} else {
					$admin1 = 0;
				}
				
				if ($_SESSION['admin']){
					$userId2 = $page_id;		
				} else {
					$userId2 = $_SESSION['userId'];
				}
		    	$name = cleanString($_POST['name']);
				$email = cleanEmail($_POST['email']); 
				$password = $_POST['password'];
							
				$problems = array();
				
				if (empty($name)){
					$problems['name'] = ' Your name is required.<br>';
				}
				if (empty($email)){
					$problems['email'] = ' Please enter a correctly formatted email.<br>';
				}
				if (empty($password)){
					$problems['password'] = ' Your password is required.<br>';
				}
				
				if (strlen($password)<8 or strlen($password) > 20) {
					$problems['pLength'] = " Your password must have between 8 and 20 characters.";
	  			}	
	  								
				// If problems are found send them back to be fixed
				if (!empty($problems))
				{	
					foreach ($problems as $problem){
						$_SESSION['$alerts'] .= $problem;
					}
					header('Location: /view/edit_user.php');
				}
				
				$password = hashPassword($password);
						
				// If no problems, proceed with the database interaction
				if(empty($problems))
				{
					$insertresult = editUser($userId2, $name, $email, $password, $admin1);				
					// Test what was returned from the model
					if ($insertresult){ 
						$_SESSION['$alerts'] .= "The account has been updated.";
					} else {
						$_SESSION['$alerts'] .= "There was an error updating the account.";
					}
					header('Location: /view/profile.php');
				}		    		
	    	} else {
		    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
		    		header('Location: /view/blank.php');
	    	}
			break;
			
		case 'confirm_delete_user':
			if ($_SESSION['login']){
	    		$uId = $_SESSION['userId'];
	    		if ($_SESSION['admin']){
					$uId = $page_id;
	    		}
	    		$_SESSION['confirm_id'] = $uId;
	    		header('Location: /view/confirm_user.php');
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
			break;	
		
		case 'delete_user':
			if ($_SESSION['login']){
				$userI = $_SESSION['userId'];
	    		if ($_SESSION['admin']){
					$userI = $page_id;
	    		}  		
	    		$isDeleted = deleteUser($userI);
	    			    		
	    		if($isDeleted){
					$_SESSION['$alerts'] .= "User Deleted.<br>";
					if ($_SESSION['userId'] == $userI){
						$_SESSION = array();
						session_destroy();
						include $_SERVER['DOCUMENT_ROOT']. '/view/header.php';
						echo "User Deleted.";
						include $_SERVER['DOCUMENT_ROOT']. '/view/footer.php'; 
					} else {
						header('Location: /view/profile.php');
					}
	    		} else  {
		    		$_SESSION['$alerts'] .= "An error occurred while attempting to delete the user.";
					header('Location: /view/profile.php');
	    		}				
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
				header('Location: /view/blank.php');
    		}
			break;
		
		case 'list_content':
			if ($_SESSION['admin']){
				header('Location: /view/list.php');
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
				header('Location: /view/blank.php');
    		}
			break;
		
		case 'create_content':
			if ($_SESSION['admin']){
	    		header('Location: /view/create.php');
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
			break;

		
		
		
		
		
		
		
		
		
		case 'save_content';
			if ($_SESSION['admin']){
				$title = cleanString($_POST['title']);
				$cooking_time = cleanString($_POST['cooking_time']);
				$difficulty = cleanString($_POST['difficulty']); 
				$ingredients = encodeTags($_POST['ingredients']); 
				$directions = encodeTags($_POST['directions']); 
				$image_name = cleanString($_POST['image_name']);
				$poster = $_SESSION['userId'];
				
				/*
				$_SESSION['$alerts'] .= $title;
				$_SESSION['$alerts'] .= $cooking_time;  
				$_SESSION['$alerts'] .= $difficulty;  
				$_SESSION['$alerts'] .= $ingredients;  
				$_SESSION['$alerts'] .= $directions; 
				$_SESSION['$alerts'] .= $image_name;
				$_SESSION['$alerts'] .= $poster; 
				*/ 

				  
				$problems = array();
				
				if (empty($title)){
					$problems['title'] = '*The title must be supplied.<br>';
				}
				if (empty($ingredients) or empty($directions)){
					$problems['empty'] = '*You must enter the ingredients and directions.<br>';
				}
				
			
				// If problems are found send them back to be fixed
				if (!empty($problems))
				{	
					foreach ($problems as $problem){
						$_SESSION['$alerts'] .= $problem;
					}
					header('Location: /view/create.php');
				}
						
				// If no problems, proceed with the database interaction
				if
				(empty($problems)){
					$insertresult = insertContent($title, $cooking_time, $difficulty, $ingredients, $directions, $image_name, $poster);
				
					// Test what was returned from the model
					if ($insertresult)
					{
						$_SESSION['$alerts'] .= "The page has been created."; 
					} else {
						// it failed
						$_SESSION['$alerts'] .= "Sorry, an error occurred while attempting to create your page.";
					}
					header('Location: /view/list.php');
	
				}
				
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
			break;	
    	
    	case 'edit_content':
    		if ($_SESSION['admin']){
    			$_SESSION['linkId'] = $page_id;
	    		header('Location: /view/edit.php');	
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
    		break;
    	
    	case 'update_content':	
			if ($_SESSION['admin']){
				$title = cleanString($_POST['title']);
				$cooking_time = cleanString($_POST['cooking_time']);
				$difficulty = cleanString($_POST['difficulty']); 
				$ingredients = encodeTags($_POST['ingredients']); 
				$directions = encodeTags($_POST['directions']); 
				$image_name = cleanString($_POST['image_name']);
				$poster = $_SESSION['userId'];
				
				$oldTitle = cleanString($_POST['oldTitle']);
				
				/*
				$_SESSION['$alerts'] .= $title;
				$_SESSION['$alerts'] .= $cooking_time;  
				$_SESSION['$alerts'] .= $difficulty;  
				$_SESSION['$alerts'] .= $ingredients;  
				$_SESSION['$alerts'] .= $directions; 
				$_SESSION['$alerts'] .= $image_name;
				$_SESSION['$alerts'] .= $poster; 
				*/ 

				  
				$problems = array();
				
				if (empty($title)){
					$problems['title'] = '*The title must be supplied.<br>';
				}
				if (empty($ingredients) or empty($directions)){
					$problems['empty'] = '*You must enter the ingredients and directions.<br>';
				}
				
			
				// If problems are found send them back to be fixed
				if (!empty($problems))
				{	
					foreach ($problems as $problem){
						$_SESSION['$alerts'] .= $problem;
					}
					header('Location: /view/create.php');
				}
						
				// If no problems, proceed with the database interaction				
				if
				(empty($problems))
				{
					$insertWorked = updateContent($oldTitle, $title, $cooking_time, $difficulty, $ingredients, $directions, $image_name, $poster);
					
					// Test what was returned from the model
					if ($insertWorked)
					{
						$_SESSION['$alerts'] .= "The page has been created."; 
					} else {
						// it failed
						$_SESSION['$alerts'] .= "Sorry, an error occurred while attempting to update your page.";
					}
					header('Location: /view/list.php');
	
				}
	    	} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}	
	    		break;	
    	
    	case 'confirm_delete_content':
    		if ($_SESSION['admin']){
    			$_SESSION['confirm_id'] = $page_id;
	    		header('Location: /view/confirm.php');	    
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}    
    		break;
    	
    	case 'delete_content':
			if ($_SESSION['admin']){				
				$isDeleted = deleteContent($page_id);	
	    		if($isDeleted){
					$_SESSION['$alerts'] .= "Page Deleted";
	    		} else  {
		    		$_SESSION['$alerts'] .= "An error occurred while attempting to delete the page.";
	    		}
				header('Location: /view/list.php');   		
     		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
    		break;

		
		
		
		
		
		
		
		
		
		
		
		case 'assignments':
			header('Location: /view/assignments.php');
			break;
		case 'content':
		default:
			buildContent($page_id);
			break;		
	}
?>