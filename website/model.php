<?php

function editUser($userId5, $name, $email, $password, $admin){
	global $link;
	global $db;
	try {
		$sql = "UPDATE $db.users SET `name`= :name,`email`= :email,`password`= :password,`admin`= :admin WHERE id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->bindValue(':admin', $admin);
		$stmt->bindValue(':id', $userId5);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in edit user");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($rowcount < 1) {		
		error_log("rowcount < 1 on edit user");
		return false;
	} else {
		return true;
	}
}

function deleteUser($userId){
	global $link;
	global $db;
	
	try {
		$sql = "DELETE FROM $db.users WHERE id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $userId);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in delete user");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($rowcount < 1) {		
		error_log("rowcount < 1 on delete user");
		return false;
	} else {
		return true;
	}
}

function getPeople(){
	global $link;
	global $db;
	
	try {
		$sql = "SELECT * FROM $db.users";

		$stmt = $link->prepare($sql);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		$results = $stmt->fetchAll();

		$stmt->closeCursor();
	} catch (PDOException $e){
		echo("PDOException in getting everyone");
		return 0;
	}	
	
	if($rowcount < 1) {		
		echo("error getting everyone");
		return 0;
	} 	
	
	return $results;		
}

function getIsAdmin($userId){
	global $link;
	global $db;
	
	$admin = null;
	try {
		$sql = "SELECT * FROM $db.users WHERE id = :id";

		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $userId);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		$results = $stmt->fetchAll();

		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in get is admin");
		return 0;
	}	
	
	if($rowcount < 1) {		
		error_log("error getting admin rights");
	} else {
		foreach ($results as $result){
			$admin = $result['admin'];
		}
	}	
	return $admin;
	
}

function getUserId($email){
	global $link;
	global $db;
	
	$id = null;
	try {
		$sql = "SELECT * FROM $db.users WHERE email = :email";

		$stmt = $link->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		$results = $stmt->fetchAll();

		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in check credentials");
		return 0;
	}	
	
	if($rowcount < 1) {		
		error_log("error getting user id");
	} else {
		foreach ($results as $result){
			$id = $result['id'];
		}
	}	
	return $id;
}

function checkCredentials($email, $password){
	global $link;
	global $db;
	
	try {
		$sql = "SELECT * FROM $db.users WHERE email = :email AND password = :password";

		$stmt = $link->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in check credentials");
		return 0;
	}	
	
	if($rowcount == 1) {		
		return true;
	} else {
		error_log("no matching email and password");
		return false;
	}	
}

function searchForPerson($email){
	global $link;
	global $db;
	
	try {
		$sql = "SELECT * FROM $db.users WHERE email = :email";

		$stmt = $link->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in search for person");
		return 1;
	}	
	
	if($rowcount > 0) {		
		error_log("found a matching email");
		return true;
	} else {
		return false;
	}
}

function insertPerson($name, $email, $password){
	global $link;
	global $db;
	
	try {
		$sql = "INSERT INTO $db.users (`name`, `email`, `password`, `admin`)
				VALUES (:name, :email, :password, false)";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in insertContent 1");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($rowcount < 1) {		
		error_log("rowcount < 1 on insertPerson");
		return false;
	} else {
		return true;
	}
}

function getContentIdFromLinkId($linkId){
	//get link title
	$headers = getLinks('header');
	$footers = getLinks('footer');
	$title = null;
	
	
	if (empty($headers) or empty($footers)){
		error_log("empty content");
		return 0;
	} else {
		foreach ($headers as $head){
			if ($head['id'] == $linkId){
				$title = $head['title'];
			}
		}
		foreach ($footers as $foot){
			if ($foot['id'] == $linkId){
				$title = $foot['title'];
			}
		}		
	}
	$contentId = getPageId($title);	
	return $contentId;
}

function deleteContent($linkId){
	global $link;
	global $db;

	//get link title
	$headers = getLinks('header');
	$footers = getLinks('footer');
	$title = null;
	
	
	if (empty($headers) or empty($footers)){
		error_log("empty content");
		return 0;
	} else {
		foreach ($headers as $head){
			if ($head['id'] == $linkId){
				$title = $head['title'];
			}
		}
		foreach ($footers as $foot){
			if ($foot['id'] == $linkId){
				$title = $foot['title'];
			}
		}		
	}	
	
	//delete page
	try{
		$sql = "DELETE FROM $db.pages WHERE title = :title";
		
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':title', $title);
		$stmt->execute();
		$stmt->closeCursor();
	} catch (PDOException $e) {
		error_log("Delete exception");
		return 0;
	}

	//delete link
	try{
		$sql = "DELETE FROM $db.links WHERE id = :id";
		
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $linkId);
		$stmt->execute();
		$stmt->closeCursor();
	} catch (PDOException $e) {
		error_log("Delete exception");
		return 0;
	}
	
	return 1;
}

function getPageId($title){
	global $link;
	global $db;
	try {
			$sql = "SELECT * 
					FROM $db.pages 
					WHERE `title` = :title";
			$stmt = $link->prepare($sql);
			$stmt->bindValue(':title', $title);
			$stmt->execute();
			$results = $stmt->fetchAll();
			$stmt->closeCursor();
		} catch (PDOException $e){
			error_log("PDOException in insertContent 3");		
			return 0;
		}
		
		foreach ($results as $result){
			$id = $result['id'];
		}
		
		return $id;		
}

function insertContent($title, $section, $aside1, $aside2, $headerOrFooter, $parent){
	$id = null;

/*
	error_log($title);
	error_log($section);
	error_log($aside1);  
	error_log($aside2);  
	error_log($headerOrFooter); 
	error_log($parent);
	error_log($id);
*/


	//bring in the database and network connection
	global $link;
	global $db;

	$link->beginTransaction();

	// A flag to determine if the transaction is working
	$flag = TRUE;
	
	//select footer links
	try {
		$sql = "INSERT INTO $db.pages(`title`, `aside1`, `aside2`, `section`)
				VALUES (:title, :aside1, :aside2, :section)";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':section', $section);
		$stmt->bindValue(':aside1', $aside1);
		$stmt->bindValue(':aside2', $aside2);
		$stmt->execute();
		
		$userid = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in insertContent 1");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($userid < 1) {
		$flag = FALSE;
		error_log("userid is < 1");
	}

	//request new page's id number
	if ($flag) {
		try {
			$sql = "SELECT * 
					FROM $db.pages 
					WHERE `title` = :title";
			$stmt = $link->prepare($sql);
			$stmt->bindValue(':title', $title);
			$stmt->execute();
			$results = $stmt->fetchAll();
			$stmt->closeCursor();
		} catch (PDOException $e){
			error_log("PDOException in insertContent 3");		
			return 0;
		}
		
		foreach ($results as $result){
			$id = $result['id'];
		}
	}
	
	if ($id == null){
		$flag = false;
		error_log("could not get id");
	}
	
	
	//If flag is still true, attempt the second insert
	if ($flag) {
		
		$urlLink = createLink($id);

    	try {
			$sql = "INSERT INTO $db.links (`title`, `link`, `header/footer`, `parent`)
					VALUES (:title, :link, :headerOrFooter, :parent)";
			$stmt = $link->prepare($sql);
			
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':link', $urlLink);
			$stmt->bindValue(':headerOrFooter', $headerOrFooter);
			$stmt->bindValue(':parent', $parent);
			$stmt->execute();
			
			$rowcount = $stmt->rowCount();
			
			$stmt->closeCursor();
		} catch (PDOException $e){
			error_log("PDOException in insertContent 3");
			return 0;
		}		
	}
		
		

	if ($rowcount != 1) {
		error_log("rowcount !=1");
		$flag = FALSE; //The insert failed
	}



	// Check if flag is true
	if ($flag) {
		// Make all inserts permanent
		$link->commit();
		error_log("success");
		return 1; // A successful registration
	} else {
		// The flag is false, get rid of any 
		// inserted data from the transaction
		$link->rollback();
		error_log('failed');
		return 0; // A failed registration
	}
		
}

function updateContent($oldTitle, $title, $section, $aside1, $aside2, $headerOrFooter, $parent){
	$pageId = getPageId($oldTitle);
/*	error_log("old title: $oldTitle");
	error_log("title: $title");
	error_log("section: $section");
	error_log("aside1: $aside1");  
	error_log("aside2: $aside2");  
	error_log("horf: $headerOrFooter"); 
	error_log("parent: $parent");
	error_log("pageid: $pageId");
*/
	//bring in the database and network connection
	global $link;
	global $db;

	$link->beginTransaction();

	// A flag to determine if the transaction is working
	$flag = TRUE;
	
	$flag1 = true;
	$flad2 = true;
	
	//select footer links
	try {
		$sql = "UPDATE $db.pages SET title = :title, aside1 = :aside1, aside2 = :aside2, section = :section WHERE id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':section', $section);
		$stmt->bindValue(':aside1', $aside1);
		$stmt->bindValue(':aside2', $aside2);
		$stmt->bindValue(':id', $pageId);
		$stmt->execute();
		
		$userid = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in UpdateContent 1");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($userid < 1) {
		$flag1 = FALSE;
		error_log("userid is < 1");
	}

	
	if ($pageId == null){
		$flag = false;
		error_log("could not get id");
	}
	
	
	//If flag is still true, attempt the second insert
	if ($flag) {
		
		
    	try {
			$sql = "UPDATE $db.links SET `title`= :title, `header/footer`= :headerOrFooter,`parent`= :parent WHERE title = :oldTitle";
			$stmt = $link->prepare($sql);
			
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':headerOrFooter', $headerOrFooter);
			$stmt->bindValue(':parent', $parent);
			$stmt->bindValue(':oldTitle', $oldTitle);
			$stmt->execute();
			
			$rowcount = $stmt->rowCount();
			
			$stmt->closeCursor();
		} catch (PDOException $e){
			error_log("PDOException in insertContent 3");
			return 0;
		}		
	}	

	if ($rowcount < 1) {
		error_log("rowcount < 1");
		$flag2 = FALSE; //The insert failed
	}

	if (!$flag1 and !$flag2){
		$flag = false;
	}
	
	// Check if flag is true
	if ($flag) {
		// Make all inserts permanent
		$link->commit();
		error_log("success");
		return 1; // A successful registration
	} else {
		// The flag is false, get rid of any 
		// inserted data from the transaction
		$link->rollback();
		error_log('failed');
		return 0; // A failed registration
	}
}


function getTitle($id){
	$contents = getContent($id);
	foreach ($contents as $content){
		return $content['title'];	 
	}
}

function getContent($id){

	//bring in the database and network connection
	global $link;
	global $db;

	//select footer links
	try {
		$sql = "SELECT * 
				FROM $db.pages 
				WHERE `id` = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	} catch (PDOException $e){
		echo 'failure';
		return null;
	}		
}

function getLinks($location){

	//bring in the database and network connection
	global $link;
	global $db;

	//select footer links
	try {
		$sql = "SELECT * 
				FROM $db.links 
				WHERE `header/footer` = :location
				ORDER BY 'id'";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':location', $location);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	} catch (PDOException $e){
		echo 'failure';
		return null;
	}		
}

?>