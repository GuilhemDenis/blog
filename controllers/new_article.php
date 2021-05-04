<?php
if(!isset($_SESSION['admin']))
{
	//stocker la page demandée dans une session
	$_SESSION['url'] = $_SERVER['QUERY_STRING'];
	header('location:index.php?page=admin');
	exit;
}



include 'models/articles.php';
include 'models/categories.php';
include 'models/writers.php';

$categories = getAllCategories();
$writers = getAllWriters();

//récupération des données du formulaire d'ajout d'article
if (isset($_GET['idModif']))
{
    $article = getArticleById($_GET['idModif']);
    
    if (!empty($_POST))
    {
        $category = $_POST['category'];
        $writer = $_POST['writer'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = $_POST['date'];
        
        if ($_POST['draft'] == null)
            $post = 1;
        else
            $post = 0;
    
        if (!empty($_FILES['img']['name']))
        {
            $img_name = $_FILES['img']['name'];
            $img = "assets/img/$img_name";
            $tmp_name = $_FILES['img']['tmp_name'];
            move_uploaded_file ($tmp_name, $img );
        }
        else {
            $img = $article['image'];
        }
        
        $id = $_GET['idModif'];
        updateArticle($category, $writer, $title, $img, $text, $date, $post, $id);
    	header('location:index.php?page=dashboard');
    	exit;
    }
}
else
{
    if (!empty($_POST))
    {
        $category = $_POST['category'];
        $writer = $_POST['writer'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = $_POST['date'];
        
        
        if ($_POST['draft'] == null)
            $post = 1;
        else
            $post = 0;
        
        $img_name = $_FILES['img']['name'];
        $img = "assets/img/$img_name";
        $tmp_name = $_FILES['img']['tmp_name'];
        
        move_uploaded_file ($tmp_name  , $img );
        
        insertArticle($category, $writer, $title, $img, $text, $date, $post);
    	header('location:index.php?page=dashboard');
    	exit;
    }
}










$template = "new_article.phtml";
include 'views/layout.phtml';