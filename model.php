<?php




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