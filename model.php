<?php

function getContent($page_id){
	//connect to database
	global $link;
	global $db;
	
	
	//fetch info from database
	try {
		$sql = "select * from posts p inner join links l on p.link_id = l.link_id where post_id = :id";
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