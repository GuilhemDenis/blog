<?php
session_start(); //démarrer le système de session


//vérifier si j'ai un paramètre page
if(isset($_GET['page']))
{
	//tester les valeurs possibles pour le paramètre
	switch($_GET['page'])
	{
		case 'article':
			include 'controllers/article.php';
			break;
		case 'liste':
			include 'controllers/liste_articles.php';
			break;
		case 'category':
			include 'controllers/category.php';
			break;
		case 'admin':
			include 'controllers/admin.php';
			break;
		case 'dashboard':
			include 'controllers/dashboard.php';
			break;	
		case 'newArticle':
			include 'controllers/new_article.php';
			break;
		case 'comments':
			include 'controllers/dashboard_comments.php';
			break;
		case 'dashboardCategories':
			include 'controllers/dashboard_categories.php';
			break;
		case 'writer':
			include 'controllers/writer.php';
			break;
		case 'writers':
			include 'controllers/dashboard_writers.php';
			break;
		case 'newWriter':
			include 'controllers/new_writer.php';
			break;
		case 'search':
			include 'controllers/search.php';
			break;
		case 'drafts':
			include 'controllers/drafts.php';
			break;
		case 'searchCompletion':
			include 'controllers/searchCompletion.php';
			break;
	}
	
}
else
{
	//Afficher la page d'accueil
	include 'controllers/accueil.php';
}
