<?php


//chercher les datas dans le model
include 'models/articles.php';


if (!isset($_POST['sort'])){
	$_POST['sort'] = "ORDER BY articles.id DESC";
}

$allArticles  = listArticles(isset($_POST['sort']) ? $_POST['sort'] : "");








//appeler la vue 

$template = "views/liste_articles.phtml";
include 'views/layout.phtml';