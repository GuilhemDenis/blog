<?php
if(!isset($_SESSION['admin']))
{
    $_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}

include 'models/writers.php';
include 'models/articles.php';

$writers = getAllWriters();

if(isset($_GET['idDeleteWriter']))
{
	deleteWriterById($_GET['idDeleteWriter']);
	header('location:index.php?page=writers');
		exit;
}





$template = "views/dashboard_writers.phtml";
include 'views/layout.phtml';