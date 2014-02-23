<?php

function upload_file($name) {
    global $image_dir_path;
    if (isset($_FILES[$name])) {
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return null;
        }
        $source = $_FILES[$name]['tmp_name'];
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        move_uploaded_file($source, $target);

		return $filename;
        // create the '400', '250', and '100' versions of the image
        //process_image($image_dir_path, $filename);
    }
    
    return null;
}

function hashPassword($password) {
	$crypt = crypt($password, 'Ns');
	return $crypt;
}


//functions to sanitize and validate user input
	
function cleanString ($string){
	$string = trim($string);
	$string = removeTags ($string);
	$string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	return $string;
}

function cleanEmail ($email){
	$email = trim($email);
	$email = removeTags($email);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	return $email;
}
	
function removeTags ($string){
	$string = trim($string);
	$string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); //strip_tags($input);
	return $string;
}
		
function encodeTags ($string){
	$string = htmlentities($string);
/* 	$string = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS); //htmlspecialchars($input); */
	return $string;
}

//BUILD FUNCTIONS

function createLink($id){
	
	$link = "index.php?action=content&amp;page_id=" . $id;
	return $link;
}

function buildSearchResults($searchTerm){
	
	$headers = array();
	$headers = search($searchTerm);
	 
	if(!empty($headers)){
		$navigation = "<ul>";	 
		foreach ($headers as $head){
				$navigation .= "<li><h2><a href='http://cs313.nathantschultz.com/?action=content&amp;page_id=" . $head['post_id'] . "'>". $head['title'] . "</a></h2></li>";			
		}
		$navigation .= "</ul>";
	
	} else {
		$navigation = 'Sorry, no results found.';
	}
	return $navigation;
	
	
}

function buildListOfContent(){
	
	$headers = array();
	$headers = getLinks();

	 
	 
	if(is_array($headers)){
		$navigation = "<ul>";	 
		foreach ($headers as $head){
				$navigation .= "<li><h2><a href='http://cs313.nathantschultz.com/?action=content&amp;page_id=" . $head['post_id'] . "'>". $head['title'] . "</a></h2> <a href='http://cs313.nathantschultz.com/index.php?action=edit_content&amp;page_id=". $head['post_id'] ."'>Edit </a> <a href='http://cs313.nathantschultz.com/index.php?action=confirm_delete_content&amp;page_id=". $head['post_id'] ."'>Delete</a></li>";			
		}
		$navigation .= "</ul>";
	
	} else {
		$navigation = 'Sorry, a critical error occurred.';
	}
	return $navigation;
	
	
}

function buildUserProfile($id){	
	$people = getPeople();
	$content = null;
	$admin = null;
	
	foreach ($people as $person){
		if ($person['user_id'] == $id){
			if($person['admin']){
				$admin = "YES";
			} else {
				$admin = "NO";
			}																																																						
			$content .= "<h2>".$person['name']."</h2><ul><li>EMAIL: ". $person['email']."</li><li>PASSWORD: ***********</li><li>ADMIN: ".$admin."</li><li><a href='http://cs313.nathantschultz.com/index.php?action=edit_user&amp;page_id=".$person['user_id']."'>edit </a> <a href='http://cs313.nathantschultz.com/index.php?action=confirm_delete_user&amp;page_id=".$person['user_id']."'>delete</a></li></ul>";   
		}
	}
	
	return $content;	
}

function buildAdminProfile(){
	
	
	//display content list link
	
	//display list of users with editing abilitiy for each part
	$people = getPeople();
	$content = "<h1><a href='http://cs313.nathantschultz.com/index.php?action=list_content'>EDIT CONTENT</a></h1><h1>USERS:</h1><ul>";
	$admin = null;
	
	foreach ($people as $person){
		if ($person['admin']) {
			$admin = "YES";
		} else {
			$admin = "NO";
		}
		$content .= "<li><h2>".$person['name']."</h2><ul><li>EMAIL: ". $person['email']."</li><li>PASSWORD: ***********</li><li>ADMIN: ".$admin."</li><li><a href='http://cs313.nathantschultz.com/index.php?action=edit_user&amp;page_id=".$person['user_id']."'>edit </a> <a href='http://cs313.nathantschultz.com/index.php?action=confirm_delete_user&amp;page_id=".$person['user_id']."'>delete</a></li></ul></li>";   	
	}
	return $content;
}



function buildNav(){
	$links = getLinks();
		
	if (is_array($links)){
		$nav = "";

		foreach ($links as $link){		
			$nav .= "<li><a href='http://cs313.nathantschultz.com/?action=content&amp;page_id=" . $link['post_id'] . "'>". $link['title'] . "</a>";
		}
		
	} else {
		$nav = "<li>Sorry, a critical error occurred.</li>";
	}
	
	return $nav;
	
}


function buildContent($page_id){
	$page = "";

	//get contents of page
	if ($page_id == 1){
		$page .= "<h1 id='welcome'></h1>";	
	} else {
		$contents = getContent($page_id);
			
		if (empty($contents)){
			
			$page .= "<h1 id='welcome'>404 Error:</h1><h1>Page not found</h1>";
		} 	else {
			foreach ($contents as $content){
				if ($content['image_name']){
					$page .= "<img src='/images/" . $content['image_name'] . "' alt='" . $content['title'] . "' >" . "<br />";
				}
				$page .= "<h1>" . $content['title'] . "</h1><p id='submitted'><em>submitted by " . $content['name'] . "</em></p><p><strong>Difficulty: </strong>" . $content['difficulty'] . "</p><p><strong>Cooking time:</strong> " . $content['cooking_time'] . "</p><p><strong>Ingredients:</strong> " . $content['ingredients'] . "</p><p><strong>Directions:</strong> " . $content['directions'] . "</p>";
			}
		}
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php'; 
	//echo $alerts;
	//$alerts = "";
	
	echo "<section class='content' id='c$page_id'>";
	 
	if(!isset($_SESSION['$alerts'])){
		$_SESSION['$alerts'] = false;
	}
	
	if($_SESSION['$alerts']){
		echo $_SESSION['$alerts'] . "<br />";
		$_SESSION['$alerts'] = "";  
	}

	
	//display content and footer
	echo $page;
	echo "</section></body></html>";

}



?>



	
	

