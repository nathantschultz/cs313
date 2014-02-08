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






function buildContent($page_id){

	//get contents of page
	if ($page_id == 1){
		$page = "<h1 id='welcome'>Welcome!</h1>";	
	} else {
		$contents = getContent($page_id);
			
		if (empty($contents)){
			
			$page = "<h1 id='welcome'>404 Error:</h1><h1 id='welcome'>Page not found</h1>";
		} 	else {
			foreach ($contents as $content){
				$page = $content['title'];
				//$page = $content['aside1'] . $content['section'] . $content['aside2'];	 
			}
		}
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php'; 
	//echo $alerts;
	//$alerts = "";
	
	echo "<div class='content' id='$page_id'>";
	
	//display content and footer
	echo $page;
	echo "</div></body></html>";

}



?>



	
	

