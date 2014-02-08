<?php

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



function buildNav(){
	$links = getLinks();
		
	if (is_array($links)){
		$nav = "";

		foreach ($links as $link){		
			$nav .= "<li><a href='http://cs313.nathantschultz.com/?action=content&page_id=" . $link['post_id'] . "'>". $link['title'] . "</a>";
		}
		
	} else {
		$nav = "<li>Sorry, a critical error occurred.</li>";
	}
	
	return $nav;
	
}


function buildContent($page_id){

	//get contents of page
	if ($page_id == 1){
		$page = "<h1 id='welcome'></h1>";	
	} else {
		$contents = getContent($page_id);
			
		if (empty($contents)){
			
			$page = "<h1 id='welcome'>404 Error:</h1><h1>Page not found</h1>";
		} 	else {
			foreach ($contents as $content){
				$page = "<img src='/images/" . $content['image_name'] . ".png' alt='" . $content['title'] . "' >" . "<br /><h1>" . $content['title'] . "</h1><p id='submitted'><em>submitted by " . $content['name'] . "</em></p><p><strong>Difficulty: </strong>" . $content['difficulty'] . "</p><p><strong>Cooking time:</strong> " . $content['cooking_time'] . "</p><p><strong>Ingredients:</strong> " . $content['ingredients'] . "</p><p><strong>Directions:</strong> " . $content['directions'] . "</p>";
			}
		}
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php'; 
	//echo $alerts;
	//$alerts = "";
	
	echo "<div class='content' id='c$page_id'>";
	
	//display content and footer
	echo $page;
	echo "</div></body></html>";

}



?>



	
	

