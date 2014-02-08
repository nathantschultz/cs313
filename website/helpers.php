<?php

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
	$string = removeTags ($string);
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
	
	$link = "index.php?action=content&amp;id=" . $id;
	return $link;
}

function buildListOfContent(){
	
	$headers = array();
	$footers = array();
	$headers = getLinks('header');
	$footers = getLinks('footer');

	 
	 
	if(is_array($headers) and is_array($footers)){
		$navigation = "<ul>";	 
		foreach ($headers as $head){
				$navigation .= "<li><h1><a href='" . $head['link'] . "'>". $head['title'] . "</a></h1> <a href='http://www.nathantschultz.com/index.php?action=edit_content&amp;id=". $head['id'] ."'>Edit</a> <a href='http://www.nathantschultz.com/index.php?action=confirm_delete_content&amp;id=". $head['id'] ."'>Delete</a></li>";			
		}
		foreach ($footers as $foot){
				if ($foot['id'] > 2){
					$navigation .= "<li><h1><a href='" . $foot['link'] . "'>". $foot['title'] . "</a></h1> <a href='http://www.nathantschultz.com/index.php?action=edit_content&amp;id=". $foot['id'] ."'>Edit</a> <a href='http://www.nathantschultz.com/index.php?action=confirm_delete_content&amp;id=". $foot['id'] ."'>Delete</a></li>";			
				}
		}
		$navigation .= "</ul>";
	
	} else {
		$navigation = 'Sorry, a critical error occurred.';
	}
	return $navigation;
	
	
}

function buildParents($selected = null){
	$parents = getLinks('header');
	$options = "";
	foreach ($parents as $parent){
		if ($parent['parent'] == null){
			$options .= "<option value='" . $parent['id']."' ";
			if ($selected == $parent['id']){
				$options .= "selected";
			}
			$options .= " >". $parent['title']."</option>";
		}
	}
	
	return $options;
}

function buildContent($id){
	$contents = getContent($id);
	
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php'; 
	echo $alerts;
	$alerts = "";
	
	if (empty($contents)){
		
		$page = "<h1 id='welcome'>404 Error:</h1><h1 id='welcome'>Page not found</h1>";
	} 	else {
		foreach ($contents as $content){
			$page = $content['aside1'] . $content['section'] . $content['aside2'];	 
		}
	}
	
	
	$page = html_entity_decode($page); // DECODING NOT WORKING
	echo $page;
	include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php';
}

function buildFooterNav(){
	$links = array();
	$links = getLinks('footer');

	 
	 
	if(is_array($links)){
		$navigation = "<ul>";	 
		foreach ($links as $link){
				$navigation .= "<li><a href='http://www.nathantschultz.com/" . $link['link'] . "'>". $link['title'] . "</a></li>";			
		}
	
		$navigation .= "</ul>";
	
	} else {
		$navigation = 'Sorry, a critical error occurred.';
	}
	return $navigation;
}

function buildHeaderNav(){
	$links = array();
	$links = getLinks('header');

	 
	 
	if(is_array($links)){
	
		$navigation = "<ul id='top_nav'>";
		foreach ($links as $link){
			if (!$link['parent']){
				$navigation .= "<li><a href='http://www.nathantschultz.com/" . $link['link'] . "'>". $link['title'] . "</a>";
				$id = $link['id'];
				
				$navigation .= "<ul>";
				foreach ($links as $link){
					if ($link['parent'] == $id){
					 	$navigation .= "<li><a href='http://www.nathantschultz.com/" . $link['link'] . "'>". $link['title'] . "</a></li>";
					}	
				}
				$navigation .= "</ul></li>";
			}	
		}
/* 		$navigation .= '</ul>'; */

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
		if ($person['id'] == $id){
			if($person['admin']){
				$admin = "YES";
			} else {
				$admin = "NO";
			}																																																						
			$content .= "<h1>".$person['name']."</h1><ul><li>EMAIL: ". $person['email']."</li><li>PASSWORD: ***********</li><li>ADMIN: ".$admin."</li><li><a href='http://www.nathantschultz.com/index.php?action=edit_user&amp;id=".$person['id']."'>edit</a> <a href='http://www.nathantschultz.com/index.php?action=confirm_delete_user&amp;id=".$person['id']."'>delete</a></li></ul>";   
		}
	}
	
	return $content;	
}

function buildAdminProfile(){
	
	
	//display content list link
	
	//display list of users with editing abilitiy for each part
	$people = getPeople();
	$content = "<h1><a href='http://www.nathantschultz.com/index.php?action=list_content'>EDIT CONTENT</a></h1><h1>USERS:</h1><ul>";
	$admin = null;
	
	foreach ($people as $person){
		if ($person['admin']) {
			$admin = "YES";
		} else {
			$admin = "NO";
		}
		$content .= "<li><h1>".$person['name']."</h1><ul><li>EMAIL: ". $person['email']."</li><li>PASSWORD: ***********</li><li>ADMIN: ".$admin."</li><li><a href='http://www.nathantschultz.com/index.php?action=edit_user&amp;id=".$person['id']."'>edit</a> <a href='http://www.nathantschultz.com/index.php?action=confirm_delete_user&amp;id=".$person['id']."'>delete</a></li></ul></li>";   	
	}
	return $content;
}

?>