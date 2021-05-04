<?php

include 'models/articles.php';
include 'models/comments.php';

if(!isset($_GET['idArticle']))
{
	header('location:index.php');
	exit;
}

$articleId = $_GET['idArticle'];
$article = getArticleById($_GET['idArticle']);


//récupération des données du formulaire de commentaire
if (!empty($_POST))
{
    $pseudo = $_POST['pseudo'];
    $comment = $_POST['comment'];
    insertComment($articleId, $pseudo, $comment);
}
else
{
    
}
$comments = getComments($articleId);

$template = "article.phtml";
include 'views/layout.phtml';