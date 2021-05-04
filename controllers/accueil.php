<?php


//chercher les datas dans le model
include 'models/articles.php';

$articles = getArticles();


//appeler la vue 

$template = "views/accueil.phtml";
include 'views/layout.phtml';





