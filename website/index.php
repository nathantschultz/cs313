<?php 
	// Start session management with a persistent cookie
	//$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
	$lifetime = 0;                      // per-session cookie
	session_set_cookie_params($lifetime, '/');	
	
	if(!$_SESSION){
		session_start();
   	}	
	
	require_once('../Database_Connections/main_db.php');
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
	if (isset($_POST['id'])) {
    			$id = $_POST['id'];
			} else if (isset($_GET['id'])) {
    			$id = $_GET['id'];
			} else {
    			$id = 1;
			}

	//
	$_SESSION['title']= $action;

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
			echo "You have been logged out.";
			include $_SERVER['DOCUMENT_ROOT']. '/view/footer.php';
			break;
		case 'check_credentials':
		
			$_SESSION['alert'] = $email;
		 	$email = $_POST['email']; 
			$password = hashPassword($_POST['password']);										
		 												
		 	$key = checkCredentials($email, $password);											
		 	$userId = getUserId($email);
			$isAdmin = getIsAdmin($userId);		 	
		
		 	if ($key and $userId){
			 	//Open sesame
			 	$_SESSION['$alerts'] .= "Access Granted.";
			 	$_SESSION['login'] = true;
			 	$_SESSION['userId'] = $userId;
			 	if($isAdmin){
			 		 	$_SESSION['admin'] = true;
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
	    		$userId1 = $_SESSION['userId'];
	    		if ($_SESSION['admin']){
					$_SESSION['$userId1'] = $id;
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
	    		
	    		error_log("before: $admin1");

				if ($_SESSION['admin'] and $admin1){
					$admin1 = true;
				} else {
					$admin1 = false;
				}

	    		error_log("after: $admin1");

				if ($_SESSION['admin']){
					$userId2 = $id;		
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
					$uId = $id;
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
					$userI = $id;
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
				$section = encodeTags($_POST['section']); 
				$aside1 = encodeTags($_POST['aside1']);
				$aside2 = encodeTags($_POST['aside2']);
				$headerOrFooter = cleanString($_POST['headerFooter']);
				$parent = cleanString($_POST['parent']);			
	/*			$_SESSION['$alerts'] .= $title;
				$_SESSION['$alerts'] .= $section;  
				$_SESSION['$alerts'] .= $aside1;  
				$_SESSION['$alerts'] .= $aside2;  
				$_SESSION['$alerts'] .= $headerOrFooter; 
				$_SESSION['$alerts'] .= $parent;  
	*/			$problems = array();
				
				if (empty($title)){
					$problems['title'] = '*The title must be supplied<br>';
				}
				if (empty($section) and empty($aside1) and empty($aside2)){
					$problems['empty'] = '*You must enter at least one section or aside<br>';
				}
				
				if ($parent == 0 or $headerOrFooter == 'footer') {
					$parent = null;
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
					$insertresult = insertContent($title, $section, $aside1, $aside2, $headerOrFooter, $parent);
				
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
    			$_SESSION['linkId'] = $id;
	    		header('Location: /view/edit.php');	
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}
    		break;
    	case 'update_content':
    		if ($_SESSION['admin']){
		    	$title = cleanString($_POST['title']);
				$section = encodeTags($_POST['section']); 
				$aside1 = encodeTags($_POST['aside1']);
				$aside2 = encodeTags($_POST['aside2']);
				$headerOrFooter = cleanString($_POST['headerFooter']);
				$parent = cleanString($_POST['parent']);
				$oldTitle = cleanString($_POST['oldTitle']);
				$problems = array();
				
				if (empty($title)){
					$problems['title'] = '*The title must be supplied<br>';
				}
				if (empty($section) and empty($aside1) and empty($aside2)){
					$problems['empty'] = '*You must enter at least one section or aside<br>';
				}
				
				if ($parent == 0 or $headerOrFooter == 'footer') {
					$parent = null;
				}
			
				// If problems are found send them back to be fixed
				if (!empty($problems))
				{	
					foreach ($problems as $problem){
						$_SESSION['$alerts'] .= $problem;
					}
					header('Location: /view/edit.php');
				}
				// If no problems, proceed with the database interaction
				if
				(empty($problems))
				{
					$insertWorked = updateContent($oldTitle, $title, $section, $aside1, $aside2, $headerOrFooter, $parent);
					
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
    			$_SESSION['confirm_id'] = $id;
	    		header('Location: /view/confirm.php');	    
    		} else {
	    		$_SESSION['$alerts'] .= "ACCESS DENIED.";
	    		header('Location: /view/blank.php');
    		}    
    		break;
    	case 'delete_content':
			if ($_SESSION['admin']){				
				$isDeleted = deleteContent($id);	
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
    	case 'content':
			buildContent($id);
			break;
		default:
    		$id = 1;
			buildContent($id);
			break;
    }

	
    
?>