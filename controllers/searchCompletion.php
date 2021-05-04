<?php


//chercher les datas dans le model
include 'models/articles.php';

if (!empty($_GET['search']))
{
    $search = $_GET['search'];
    $allArticles = searchArticles($search, $search);
    $count = countArticles($search, $search);
    
    include 'views/searchCompletion.phtml';
}
else 
{
    $articles = getArticles();
    include 'views/accueil.phtml';
}
