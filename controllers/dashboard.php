<?php

if(!isset($_SESSION['admin']))
{
	header('location:index.php?page=admin');
	exit;
}

include 'models/articles.php';

$allArticles  = getAllArticles();

if(isset($_GET['idDelete']))
{
	deleteArticleById($_GET['idDelete']);
	header('location:index.php?page=dashboard');
	exit;
}

$template = "views/dashboard.phtml";
include 'views/layout.phtml';
