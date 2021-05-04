<?php

include 'models/articles.php';

if (!empty($_POST['search']))
{
    $allArticles = searchArticles($_POST['search'], $_POST['search']);
}
else 
{
    header('location:index.php');
	exit;
}

// $search = $_GET['search'];
// $allArticles = searchArticles($search, $search);




$template = 'views/search.phtml';
include 'views/layout.phtml';