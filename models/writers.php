<?php

function getAllWriters(){
    include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT writers.id, last_name, first_name, pseudo, email
	FROM writers
	
	");
	
	$query -> execute();
	
	$writers = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $writers;
}

function getWriterNamebyId($id){
    include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT first_name, last_name
	FROM writers
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
	$writer = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $writer;
}

function getWriterbyId($id){
    include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT first_name, last_name, pseudo, email
	FROM writers
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
	$writer = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $writer;
}


function deleteWriterById($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	DELETE FROM writers
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
}


function updateWriters($firstName, $lastName, $pseudo, $email, $id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	UPDATE writers
	SET first_name = ?, last_name = ?, pseudo = ?, email = ?
	WHERE id = ?
	");
	
	$query -> execute([$firstName, $lastName, $pseudo, $email, $id]);
	
}

function addWriters($firstName, $lastName, $pseudo, $email)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	INSERT INTO writers(first_name, last_name, pseudo, email) 
	VALUES (?,?,?,?)
	");
	
	$query -> execute([$firstName, $lastName, $pseudo, $email]);
	
}

