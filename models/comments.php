<?php

function insertComment($id_article, $pseudo, $text)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	INSERT INTO comments(id_article, pseudo, comment) VALUES (?,?,?)
	");
	
	$query -> execute([$id_article,$pseudo, $text]);
	
	$comment = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $comment;
}

function getComments($id)
{
    include 'app/bdd.php';
    
    $query = $bdd -> prepare("
	SELECT id, pseudo, comment
	FROM comments
	WHERE id_article = ?
	ORDER BY id DESC
	");
	
	$query -> execute([$id]);
	
	$comments = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $comments;
}

function getAllComments()
{
	include 'app/bdd.php';
    
    $query = $bdd -> prepare("
	SELECT comments.id, pseudo, comment, comments.publication_date, articles.title
	FROM comments
	INNER JOIN articles ON id_article = articles.id
	ORDER BY id DESC
	");
	
	$query -> execute();
	
	$comments = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $comments;
}

function deleteCommentById($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	DELETE FROM comments
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
}