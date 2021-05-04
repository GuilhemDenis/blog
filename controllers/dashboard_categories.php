<?php
if(!isset($_SESSION['admin']))
{
	$_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}

include 'models/categories.php';
include 'models/articles.php';

$categories = getAllCategories();

if(isset($_GET['idDeleteCategory']))
{
	deleteCategoryById($_GET['idDeleteCategory']);
	header('location:index.php?page=dashboardCategories');
		exit;
}

if (!empty($_POST['category']))
{
	$name = $_POST['category'];
	addCategory($name);
	header('location:index.php?page=dashboardCategories');
		exit;
}

if (!empty($_POST['name']))
{
	updateCategory($_POST['name'], $_GET['idModif']);
	header('location:index.php?page=dashboardCategories');
		exit;
}





$template = "views/dashboard_categories.phtml";
include 'views/layout.phtml';