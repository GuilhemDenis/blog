<?php


//fonctions


function getArticles()
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 200) as description, writers.first_name, writers.last_name, DATE_FORMAT(articles.publication_date,'%d %M %Y') as publication_date, image, id_category, id_writer, post
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE post = 1 && articles.publication_date <= CURRENT_TIMESTAMP
	ORDER BY articles.publication_date DESC
	LIMIT 4
	");
	
	$query -> execute();
	
	$articles = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articles;
}

function getArticleById($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, articles.description, writers.first_name, writers.last_name, DATE_FORMAT(articles.publication_date,'%Y-%m-%dT%H:%i') as publication_date, image, id_category, id_writer, post
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE articles.id = ?");
	
	$query -> execute([$id]);
	
	$article = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $article;
}

function getAllArticles()
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 500) as description, writers.first_name, writers.last_name, DATE_FORMAT(articles.publication_date,'%d %M %Y à %Hh%i') as publication_date, image, post
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	ORDER BY articles.publication_date DESC
	");
	
	$query -> execute();
	
	$allArticles = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $allArticles ;
}

function listArticles($order=null)
{
	include 'app/bdd.php';
	
	$req = "
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 500) as description, writers.first_name, writers.last_name, DATE_FORMAT(articles.publication_date,'%d %M %Y à %Hh%i') as publication_date, image, post
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE post = 1 && articles.publication_date <= CURRENT_TIMESTAMP
	
	";
	
	if ($order == null)
		$order = "ORDER BY articles.publication_date DESC";
	$req .= $order;
	
	 

	$query = $bdd -> prepare($req);
	
	$query -> execute();
	
	$allArticles = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $allArticles ;
}

function getArticlesbyCategory($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 500) as description, writers.first_name, writers.last_name, articles.publication_date, image
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE articles.id_category = ?
	ORDER BY articles.publication_date DESC
	");
	
	$query -> execute([$id]);
	
	$articlesCategory = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articlesCategory;
}

function getArticlesbyWriter($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 500) as description, writers.first_name, writers.last_name, articles.publication_date, image
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE articles.id_writer = ?
	ORDER BY articles.publication_date DESC
	");
	
	$query -> execute([$id]);
	
	$articlesCategory = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articlesCategory;
}



function insertArticle($category, $writer, $title, $img, $text, $date, $post)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	INSERT INTO articles(id_category, id_writer, title, image, description, publication_date, post) 
	VALUES (?,?,?,?,?,?,?)
	");
	
	$query -> execute([$category, $writer, $title, $img, $text, $date, $post]);
	
}

function deleteArticleById($id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	DELETE FROM articles
	WHERE id = ?
	");
	
	$query -> execute([$id]);
	
}

function updateArticle($category, $writer, $title, $img, $text, $date, $post, $id)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	UPDATE articles
	SET id_category = ?, id_writer = ?, title = ?, image = ?, description = ?, publication_date = ?, post = ?
	WHERE id = ?
	");
	
	$query -> execute([$category, $writer, $title, $img, $text, $date, $post, $id, ]);
	
}


function countArticlesByWriter($id) {
	
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT COUNT(articles.id) as count
	FROM articles
	WHERE id_writer = ?
	");
	
	$query -> execute([$id]);
	
	$number = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $number;
	
}

function countArticlesByCategory($id) {
	
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT COUNT(articles.id) as count
	FROM articles
	WHERE id_category = ?
	");
	
	$query -> execute([$id]);
	
	$number = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $number;
	
}


function searchArticles($search=null, $search2=null, $order=null)
{
	include 'app/bdd.php';
	
	$req = "
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 200) as description, writers.first_name, writers.last_name, articles.publication_date, image, id_category, id_writer
	FROM articles
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE (description LIKE ? OR title LIKE ?) && post = 1 && articles.publication_date <= CURRENT_TIMESTAMP
	";
	
	if ($order == null)
		$order = "ORDER BY articles.publication_date DESC";
	$req .= $order;
	

	$query = $bdd -> prepare($req);
	
	$query -> execute(['%'.$search.'%', '%'.$search2.'%']);
	
	$articles = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articles;
}








function getAllDrafts()
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT articles.id, title, categories.name, SUBSTR(articles.description, 1, 500) as description, writers.first_name, writers.last_name, DATE_FORMAT(articles.publication_date,'%d %M %Y') as publication_date, image, post
	FROM articles 
	INNER JOIN categories ON articles.id_category = categories.id
	INNER JOIN writers ON articles.id_writer = writers.id
	WHERE post = 0
	ORDER BY articles.publication_date DESC
	");
	
	$query -> execute();
	
	$articles = $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articles ;
}

function countArticles($search, $search2)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare("
	SELECT COUNT(id) as count
	FROM articles
	WHERE (description LIKE ? OR title LIKE ?) && post = 1 && articles.publication_date <= CURRENT_TIMESTAMP
	");
	
	$query -> execute(['%'.$search.'%', '%'.$search2.'%']);
	
	$number = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $number;
}