<?php
if(!isset($_SESSION['admin']))
{
    $_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}

//chercher les datas dans le model
include 'models/articles.php';

$allArticles  = getAllDrafts();


//appeler la vue 

$template = "views/drafts.phtml";
include 'views/layout.phtml';