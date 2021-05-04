<?php

function getCategoryNamebyId($id){
    include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT name
	FROM categories
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
	$category = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $category;
}

function getAllCategories(){
    include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT name, id
	FROM categories
	");
	
	$query -> execute();
	
	$categories = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $categories;
}

function deleteCategoryById($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	DELETE FROM categories
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
}

function addCategory($name)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	INSERT INTO categories(name) 
	VALUES (?)
	");
	
	$query -> execute([$name]);
	
}

function updateCategory($name, $id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	UPDATE categories
	SET name = ?
	WHERE id = ?
	");
	
	$query -> execute([$name, $id]);
	
}