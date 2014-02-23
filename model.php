<?php

function editUser($userId5, $name, $email, $password, $admin){
	global $link;
	global $db;
	
	try {
		$sql = "UPDATE $db.users SET `name`= :name,`email`= :email,`password`= :password,`admin`= :admin WHERE user_id = :id";
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

function deleteUser($userId8){
	global $link;
	global $db;
	
	try {
		$sql = "DELETE FROM $db.users WHERE user_id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $userId8);
		$stmt->execute();
		
		$rowcount = $stmt->rowCount();
		
		$stmt->closeCursor();
	} catch (PDOException $e){
		error_log("PDOException in delete user");
		return 0;
	}	
	
	//Change flag if the insert failed
	if($rowcount < 1) {		
		error_log("rowcount < 1 on delete user: " . $userId8);
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
		$sql = "SELECT * FROM $db.users WHERE user_id = :id";

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
			$id = $result['user_id'];
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

function deleteContent($postId){
	global $link;
	global $db;

	
	//delete page
	try{
		$sql = "DELETE FROM $db.posts WHERE post_id = :id";
		
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $postId);
		$stmt->execute();
		$stmt->closeCursor();
	} catch (PDOException $e) {
		error_log("Delete exception");
		return 0;
	}

	//delete link
	try{
		$sql = "DELETE FROM $db.links WHERE post_id = :id";
		
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $postId);
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
					FROM $db.links 
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
			$id = $result['post_id'];
		}
		
		return $id;		
}




function insertContent($title, $cooking_time, $difficulty, $ingredients, $directions, $image_name, $poster){
	$post_id = null;
	

	//error_log("title: $title, cooking time: $cooking_time, difficulty: $difficulty, ingredients: $ingredients, directions: $directions, image: $image_name, poster: $poster");


	//bring in the database and network connection
	global $link;
	global $db;

	$link->beginTransaction();

	// A flag to determine if the transaction is working
	$flag = TRUE;
	
	//select footer links
	try {
		$sql = "INSERT INTO $db.posts(cooking_time, difficulty, ingredients, directions, user_id, image_name)
				VALUES (:cook, :diff, :ingred, :directions, :poster, :image)";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':cook', $cooking_time);
		$stmt->bindValue(':diff', $difficulty);
		$stmt->bindValue(':ingred', $ingredients);
		$stmt->bindValue(':directions', $directions);
		$stmt->bindValue(':poster', $poster);
		$stmt->bindValue(':image', $image_name);
		$stmt->execute();
		
		$userid = $stmt->rowCount();
		$post_id = $link->lastInsertId('post_id');
		
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
	
	if ($post_id == null){
		$flag = false;
		error_log("could not get id");
	}
	
	
	//If flag is still true, attempt the second insert
	if ($flag) {
		
    	try {
			$sql = "INSERT INTO $db.links (title, post_id)
					VALUES (:title, :post_id)";
			$stmt = $link->prepare($sql);
			
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':post_id', $post_id);
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

function updateContent($oldTitle, $title, $cooking_time, $difficulty, $ingredients, $directions, $image_name, $poster){
	$pageId = getPageId($oldTitle);

	//error_log("old title: $oldTitle title: $title, cooking time: $cooking_time, difficulty: $difficulty, ingredients: $ingredients, directions: $directions, image: $image_name, poster: $poster");

	//bring in the database and network connection
	global $link;
	global $db;

	$link->beginTransaction();

	// A flag to determine if the transaction is working
	$flag = TRUE;
	
	$flag1 = true;
	$flag2 = true;
	
	//select footer links
	try {
		$sql = "UPDATE $db.posts SET cooking_time = :cook, difficulty = :diff, ingredients = :ingred, directions = :directions, user_id = :poster, image_name = :image WHERE post_id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':cook', $cooking_time);
		$stmt->bindValue(':diff', $difficulty);
		$stmt->bindValue(':ingred', $ingredients);
		$stmt->bindValue(':directions', $directions);
		$stmt->bindValue(':poster', $poster);
		$stmt->bindValue(':image', $image_name);
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
			$sql = "UPDATE $db.links SET `title`= :title where post_id = :post_id";
			$stmt = $link->prepare($sql);
			
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':post_id', $pageId);
			$stmt->execute();
			
			$rowcount = $stmt->rowCount();
			
			$stmt->closeCursor();
		} catch (PDOException $e){
			error_log("PDOException in insertContent 3");
			return 0;
		}		
	}	

	//Change flag if the insert failed
	if($rowcount < 1) {
		error_log("rowcount < 1 for updated");
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

function search($searchTerm){
	
	//connect to database
	global $link;
	global $db;
	
	$term = "%" . $searchTerm . "%";
	error_log("searchterm is: $searchTerm");
	
	//fetch info from database
	try {
		$sql = "select * from $db.links where title like :term";
		$stmt = $link->prepare($sql);
		
		$stmt->bindValue(':term', $term);
		
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	} catch (PDOException $e){
		echo 'failure';
		return null;
	}
	
}

function getLinks(){
	//connect to database
	global $link;
	global $db;
	
	
	//fetch info from database
	try {
		$sql = "select * from $db.links order by title";
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	} catch (PDOException $e){
		echo 'failure';
		return null;
	}
}

function getContent($page_id){
	//connect to database
	global $link;
	global $db;
	
	
	//fetch info from database
	try {
		$sql = "select * from posts p inner join links l on p.post_id = l.post_id inner join users u on p.user_id = u.user_id where p.post_id = :id";
		$stmt = $link->prepare($sql);
		$stmt->bindValue(':id', $page_id);
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