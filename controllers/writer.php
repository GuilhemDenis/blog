<?php 

include 'models/articles.php';
include 'models/writers.php';


if(!isset($_GET['idWriter']))
{
	header('location:index.php');
	exit;
}
$articlesWriter = getArticlesbyWriter($_GET['idWriter']);
$writerName = getWriterNamebyId($_GET['idWriter']);


$template = "writer.phtml";
include 'views/layout.phtml';