<?php
if(!isset($_SESSION['admin']))
{
	$_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}

include 'models/comments.php';


$comments = getAllComments();


if(isset($_GET['idDeleteComment']))
{
	deleteCommentById($_GET['idDeleteComment']);
	header('location:index.php?page=comments');
		exit;
}

$template = "views/dashboard_comments.phtml";
include 'views/layout.phtml';