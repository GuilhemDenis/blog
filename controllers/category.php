<?php 

include 'models/articles.php';
include 'models/categories.php';


if(!isset($_GET['idCategory']))
{
	header('location:index.php');
	exit;
}
$articlesCategory = getArticlesbyCategory($_GET['idCategory']);
$categoryName = getCategoryNamebyId($_GET['idCategory']);


$template = "category.phtml";
include 'views/layout.phtml';